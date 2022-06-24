$('#walltetList li a').click(function (e) {
    wallet = $(this).attr('wallet');
    if (wallet == 'privatekey') {
        $('#walletPrivateKey').show()
    } else {
        $('#walletPrivateKey').hide()
    }
    $('#selectedWallet').html($(this).html());
    $('#mainWalletList').prop("checked", false);
});

function connectWallet() {
    $('.walletconnect-btn').hide();
    $('.connectLoading-btn').show();
    switch (wallet) {
        case 'rabet':
            rabbetWallet();
            break;
        case 'frighter':
            frighterWallet();
            break;
        case 'ledger':
            break;
        case 'albeto':
            albedoWallet();
            break;
        case 'xbull':
            xbullWallet();
            break;
        case 'privatekey':
            storePublic($('#walletPrivateKey').val())
            break;
        default:
            $('.walletconnect-btn').show();
            $('.connectLoading-btn').hide();
            toastr.warning('Please select Wallet', 'Selection');
    }
}

function rabbetWallet() {
    if (!window.rabet) {
        toastr.error('Please install Rabet Extension!', 'Rabbet Wallet');
        $('.walletconnect-btn').show();
        $('.connectLoading-btn').hide();
    }
    rabet.connect()
        .then(function (result) {
            storeWalletPublic(result.publicKey, 'rabet');
        })
        .catch(function (error) {
            toastr.error(`Wallet Connection Rejected!`, 'Rabbet Wallet');
            $('.walletconnect-btn').show();
            $('.connectLoading-btn').hide();
        });
}

function xbullWallet() {
    if (typeof xBullSDK == "undefined") {
        toastr.error('Please install Xbull Extension!', 'Xbull Wallet');
        $('.walletconnect-btn').show();
        $('.connectLoading-btn').hide();
    }
    xBullSDK.connect({
        canRequestPublicKey: true,
        canRequestSign: true
    }).then(function () {
        xBullSDK.getPublicKey().then(function (key) {
            storeWalletPublic(key, 'xbull');
        })
    })
        .catch(function (error) {
            toastr.error(`Error Occured`, 'Xbull Wallet');
            $('.walletconnect-btn').show();
            $('.connectLoading-btn').hide();
        });
}

function albedoWallet() {
    albedo.publicKey()
        .then(function (res) {
            console.log(res.pubkey, res.signed_message, res.signature);
            storeWalletPublic(res.pubkey, 'albeto');
        })
        .catch(function (error) {
            toastr.error(`Error Occured`, 'ALabedo Wallet');
            $('.walletconnect-btn').show();
            $('.connectLoading-btn').hide();
        });
}

const frighterPublicKey = async () => {
    let publicKey = "";
    let error = "";

    try {
        publicKey = await window.freighterApi.getPublicKey();
    } catch (e) {
        error = e;
    }

    if (error) {
        return error;
    }

    return publicKey;
};

function frighterWallet() {
    try {
        window.freighterApi.isConnected();
    } catch (error) {
        toastr.error('Please install Frighter Extension!', 'Frighter Wallet');
        $('.walletconnect-btn').show();
        $('.connectLoading-btn').hide();
    }
    frighterPublicKey()
        .then(function (publicKey) {
            if (publicKey != 'User declined access') {
                storeWalletPublic(publicKey, 'frighter');
            } else {
                toastr.error(publicKey, 'Frighter Wallet');
                $('.walletconnect-btn').show();
                $('.connectLoading-btn').hide();
            }
        })
        .catch(function (error) {
            toastr.error(`Error Occured`, 'Frighter Wallet');
            $('.walletconnect-btn').show();
            $('.connectLoading-btn').hide();
        });
}


function storeWalletPublic(public, wallet) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + '/wallet/store',
        type: "post",
        data: {
            public: public,
            wallet: wallet
        },
        success: function (response) {
            if (response.status == 1) {
                $('#topWallet').text((response.public).substring(0,4)+'...'+(response.public).slice(-5));
                $('#accountBalance').text(response.balance);
                toastr.success('Wallet Successfully Conneceted', 'Wallet Connection')
                $('.walletconnect-btn').show();
                $('.connectLoading-btn').hide();
                $('#ConnectWallet').modal('hide');
            } else {
                toastr.error(`Error: ${response.msg}`, 'Connection')
                $('.walletconnect-btn').show();
                $('.connectLoading-btn').hide();
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Deposit 5 XLM lumens into your wallet", "Wallet Error");
            $('.walletconnect-btn').show();
            $('.connectLoading-btn').hide();
        }
    });
}

function storePublic(key) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + '/wallet/secret',
        type: "post",
        data: {
            key: key,
        },
        success: function (response) {
            if (response.status == 1) {
                $('#topWallet').text((response.public).substring(0,4)+'...'+(response.public).slice(-5));
                $('#accountBalance').text(response.balance);
                toastr.success('Wallet Successfully Conneceted', 'Wallet Connection')
                $('.walletconnect-btn').show();
                $('.connectLoading-btn').hide();
                $('#ConnectWallet').modal('hide');
            } else {
                toastr.error(`Error: ${response.msg}`, 'Connection')
                $('.walletconnect-btn').show();
                $('.connectLoading-btn').hide();
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Deposit 5 XLM lumens into your wallet", "Wallet Error");
            $('.walletconnect-btn').show();
            $('.connectLoading-btn').hide();
        }
    });
}

function signXdr(xdr, location = null, questionSlug = null) {
    var signed = true;
    switch (wallet) {
        case 'rabet':
            rabet.sign(xdr, testnet ? 'testnet' : 'mainnet')
                .then(function (result) {
                    const xdr = result.xdr;
                    processXdr(xdr, location, questionSlug, 'question');
                }).catch(function (error) {
                    if (questionSlug) {
                        removeQuestion(questionSlug, location);
                    }
                });
            break;
        case 'frighter':

            window.freighterApi.signTransaction(xdr, testnet ? 'TESTNET' : 'PUBLIC').then(function (result) {
                const xdr = result;
                processXdr(xdr, location, questionSlug, 'question');
            }).catch(function (error) {
                if (questionSlug) {
                    removeQuestion(questionSlug, location);
                }
            });
            break;
        // case 'ledger':
        //     break;
        case 'albeto':

            albedo.tx({
                xdr: xdr,
                network: testnet ? 'testnet' : 'mainnet'
            })
                .then(function (result) {
                    const xdr = result.signed_envelope_xdr;
                    processXdr(xdr, location, questionSlug, 'question');
                }).catch(function (error) {
                    if (questionSlug) {
                        removeQuestion(questionSlug, location);
                    }
                });

            break;
        case 'xbull':
            xBullSDK.signXDR(xdr).then(function (result) {
                const xdr = result;
                processXdr(xdr, location, questionSlug, 'question');
            }).catch(function (error) {
                if (questionSlug) {
                    removeQuestion(questionSlug, location);
                }
            });
            break;
        default:
            processXdr(xdr, location, questionSlug, 'question');
    }
}

function processXdr(xdr, location = null, slug = null, mtype = null, tip = null) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + '/processXdr',
        type: "post",
        data: {
            xdr: xdr,
            slug: slug,
            mtype: mtype,
            tip: tip
        },
        success: function (response) {
            console.log(response);
            if (location != null) {
                window.location.href = location;
            } else {
                $('#tipModal').modal('hide');
                toastr.success(`Successful!`, 'success');
                $('#loaderModal').modal('hide');
            }
        },
        error: function (xhr, status, error) {
            if (location != null) {
                window.location.href = location;
            } else {
                toastr.error(`Error Occured!`, 'Error');
                $('#loaderModal').modal('hide');
            }
            console.log('error');
        }
    });


}