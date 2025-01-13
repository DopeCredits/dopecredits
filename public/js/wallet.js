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
        case 'freighter':
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
            displayWalletButtons(); 
            toastr.warning('Please select Wallet', 'Selection');
    }
}


async function frighterWallet() {
    // Step 1: Check if Freighter is connected
    try {
        const connected = await window.freighterApi.isConnected();
        
        if (!connected) {
            toastr.error('Freighter wallet is not connected.', 'Freighter Wallet');
            displayWalletButtons();
            return;
        }
    } catch (error) {
        toastr.error('Please install or connect the Freighter Extension!', 'Freighter Wallet');
        displayWalletButtons();
        return;
    }

    // Step 2: Retrieve the Public Key
    try {
        const publicKeyObject = await window.freighterApi.requestAccess();

        // Access the 'address' property of the object
        const publicKey = publicKeyObject.address;
        
        if (publicKey === 'User declined access') {
            toastr.error('Access declined by user.', 'Freighter Wallet');
            displayWalletButtons();
            return;
        }

        // Handle the public key (e.g., store it)
        storeWalletPublic(publicKey, 'freighter');
        // toastr.success('Freighter wallet connected successfully!', 'Freighter Wallet');
    } catch (error) {
        toastr.error('An error occurred while retrieving the public key.', 'Freighter Wallet');
        displayWalletButtons();
    }
}


function rabbetWallet() {
    if (!window.rabet) {
        toastr.error('Please install Rabet Extension!', 'Rabbet Wallet');
        displayWalletButtons(); 
    }
    rabet.connect()
        .then(function (result) {
            storeWalletPublic(result.publicKey, 'rabet');
        })
        .catch(function (error) {
            toastr.error(`Wallet Connection Rejected!`, 'Rabbet Wallet');
            displayWalletButtons(); 
        });
}

function xbullWallet() {
    if (typeof xBullSDK == "undefined") {
        toastr.error('Please install Xbull Extension!', 'Xbull Wallet');
        displayWalletButtons(); 
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
            displayWalletButtons(); 
        });
}

function albedoWallet() {
    albedo.publicKey()
        .then(function (res) {
            storeWalletPublic(res.pubkey, 'albeto');
        })
        .catch(function (error) {
            toastr.error(`Connection Rejected`, 'Albedo Wallet');
            displayWalletButtons(); 
        });
}

function kFormatter(num) {
    return Math.abs(num) > 999 ? Math.sign(num) * ((Math.abs(num) / 1000).toFixed(1)) : Math.sign(num) * Math.abs(num)
}

function number_format_short(n) {
    var n_format = 0;
    var suffix = '';
    if (n < 900) {
        // 0 - 900
        n_format = (n);
        suffix = '';
    } else if (n < 900000) {
        // 0.9k-850k
        n_format = (n / 1000);
        suffix = 'K';
    } else if (n < 900000000) {
        // 0.9m-850m
        n_format = (n / 1000000);
        suffix = 'M';
    } else if (n < 900000000000) {
        // 0.9b-850b
        n_format = (n / 1000000000);
        suffix = 'B';
    } else {
        // 0.9t+
        n_format = (n / 1000000000000);
        suffix = 'T';
    }
    return Math.floor(n_format).toString() + suffix;
}

//Storing wallets connecting from extensions like rabet etc
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

                $('#slider_single').val(10);
                $('.range-value').css('left', 'calc(0% + 10px)');
                $('.range-value').html('<span>10k</span>');

                if (response.lowAmount) {
                    $('#btnStaking').attr('disabled', true);
                    $('#slider_single').attr('disabled', true);
                    $('#eligibleError').removeAttr('hidden');
                    $('.rangeP').text('Below 10k');
                    $('#maxRange').text('Below 10k');
                } else {
                    $('#btnStaking').removeAttr('disabled');
                    $('#slider_single').removeAttr('disabled');
                    $('#eligibleError').attr('hidden', true);
                    // var accVal = Math.round((parseInt((response.balance).replace(/,/g, '')) / 1000));                    
                    var accVal = kFormatter(parseInt((response.balance).replace(/,/g, '')));
                    $('#slider_single').attr('max', Math.floor(accVal));
                    $('.rangeP').text(number_format_short(parseInt((response.balance).replace(/,/g, ''))));
                    $('#maxRange').text(number_format_short(parseInt((response.balance).replace(/,/g, ''))) + ' token');
                }
                $('.remove-btn').show();

                $('#topWallet').text((response.public).substring(0, 4) + '...' + (response.public).slice(-5));
                $('#accountBalance').text(number_format_short(parseInt((response.balance).replace(/,/g, ''))));
                $('#walletImage').attr('src', base_url + '/images/' + wallet + '.png');

                toastr.success('Wallet Successfully Conneceted', 'Wallet Connection')
                displayWalletButtons(); 
                $('#ConnectWallet').modal('hide');
            } else {
                toastr.error(`Error: ${response.msg}`, 'Connectionss')
                displayWalletButtons(); 
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Deposit 5 XLM lumens into your wallet", "Wallet Error");
            displayWalletButtons(); 
        }
    });
}

function displayWalletButtons() {
    $('.walletconnect-btn').show();
    $('.connectLoading-btn').hide();
  }

//Storing wallets connecting from secret key
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
                $('#topWallet').text((response.public).substring(0, 4) + '...' + (response.public).slice(-5));
                $('#accountBalance').text(number_format_short(parseInt((response.balance).replace(/,/g, ''))));

                $('#slider_single').val(10);
                $('.range-value').css('left', 'calc(0% + 10px)');
                $('.range-value').html('<span>10k</span>');

                if (response.lowAmount) {
                    $('#btnStaking').attr('disabled', true);
                    $('#slider_single').attr('disabled', true);
                    $('#eligibleError').removeAttr('hidden');
                    $('.rangeP').text('Below 10k');
                    $('#maxRange').text('Below 10k');
                } else {
                    $('#btnStaking').removeAttr('disabled');
                    $('#slider_single').removeAttr('disabled');
                    $('#eligibleError').attr('hidden', true);
                    // var accVal = Math.round((parseInt((response.balance).replace(/,/g, '')) / 1000));                    
                    var accVal = kFormatter(parseInt((response.balance).replace(/,/g, '')));
                    $('#slider_single').attr('max', Math.floor(accVal));
                    $('.rangeP').text(number_format_short(parseInt((response.balance).replace(/,/g, ''))));
                    $('#maxRange').text(number_format_short(parseInt((response.balance).replace(/,/g, ''))) + ' token');
                }
                $('.remove-btn').show();


                $('#walletImage').attr('src', base_url + '/images/' + wallet + '.png');

                toastr.success('Wallet Successfully Conneceted', 'Wallet Connection')
                displayWalletButtons(); 
                $('#ConnectWallet').modal('hide');
            } else {
                toastr.error(`Error: ${response.msg}`, 'Connection')
                displayWalletButtons(); 
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Deposit 5 XLM lumens into your wallet", "Wallet Error");
            displayWalletButtons(); 
        }
    });
}

function btnLoaderHide() {
    $('#btnStaking').show();
    $('#loadStaking').hide();
}

function invest(currentValue) {
    // var bal = $('#slider_single').val();
    // var bal = $('#slider_single').attr('data-value');
    // bal = (parseFloat(bal.replace(' K', "")) * 1000).toFixed(0);
    $('#btnStaking').hide();
    $('#loadStaking').show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + '/wallet/invest',
        type: "post",
        data: {
            amount: currentValue,
        },
        success: function (response) {
            if (response.status == 1) {
                signXdr(response.xdr, response.staking_id);
            } else {
                btnLoaderHide();
                toastr.error(response.msg, "Staking Error");
            }
        },
        error: function (xhr, status, error) {
            btnLoaderHide();
            toastr.error('Something went wrong!', "Staking Error");
        }
    });
}

function signXdr(xdr, staking_id) {
    switch (wallet) {
        case 'rabet':
            rabet.sign(xdr, testnet ? 'testnet' : 'mainnet')
                .then(function (result) {
                    const xdr = result.xdr;
                    submitStakingXdr(xdr, staking_id);
                }).catch(function (error) {
                    btnLoaderHide();
                    toastr.error('Rejected!', "Rabbet Wallet");
                });
            break;

        case 'freighter':
            window.freighterApi.signTransaction(xdr, testnet ? 'TESTNET' : 'PUBLIC').then(function (result) {
                const xdr = result.signedTxXdr;
                submitStakingXdr(xdr, staking_id);
            }).catch(function (error) {
                btnLoaderHide();
                toastr.error('Rejected!', "Freighter Wallet");
            });
            break;

        case 'albeto':
            albedo.tx({
                xdr: xdr,
                network: testnet ? 'testnet' : 'mainnet'
            })
                .then(function (result) {
                    const xdr = result.signed_envelope_xdr;
                    submitStakingXdr(xdr, staking_id);
                }).catch(function (error) {
                    btnLoaderHide();
                    toastr.error('Rejected!', "Albeto Wallet");
                });

            break;
        case 'xbull':
            xBullSDK.signXDR(xdr).then(function (result) {
                const xdr = result;
                submitStakingXdr(xdr, staking_id);
            }).catch(function (error) {
                btnLoaderHide();
                toastr.error('Rejected!', "xBull Wallet");
            });
            break;
        default:
            submitStakingXdr(xdr, staking_id);
    }
}

function submitStakingXdr(xdr, staking_id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + '/wallet/submitXdr',
        type: "post",
        data: {
            xdr: xdr,
            staking_id: staking_id
        },
        success: function (response) {
            if (response.status == 1) {
                toastr.success("Successful", "Staking");
            } else {
                toastr.error(response.msg, "Staking Error");
            }
            btnLoaderHide();
        },
        error: function (xhr, status, error) {
            btnLoaderHide();
            toastr.error('Something went wrong!', "Staking Error");
        }
    });
}