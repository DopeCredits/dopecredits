    <!-- bootstarp 5 js -->
    <div class="modal fade" id="ConnectWallet"
        {{ !isset($_COOKIE['public']) ? 'data-bs-backdrop=static data-bs-keyboard=false' : '' }} tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-wallet">
                <a href="{{ url('wallet/disconnect') }}" class="text-danger remove-btn"
                    style="position: absolute;z-index: 1;top: 5%;right: 4%;text-decoration:none;{{ isset($_COOKIE['public']) ? '' : 'display:none' }}">Remove
                    Wallet</a>
                <div class="modal-body">
                    <h1>Please Connect Your <br>
                        Account to Wallet</h1>
                    <div class="wallet-input">
                        <!-- Dropdown -->
                        <label class="drop">
                            <input type="checkbox" id="mainWalletList"> <!-- Toggle Drop -->
                            <span id="selectedWallet" class="control">Choose your Wallet<i
                                    class="fas fa-chevron-down mt-1 drop-connect"></i></span> <!-- Fake button -->

                            <!-- Items -->
                            <ul class="drop-items " id="walltetList">
                                <li class="item-drop wallet-drop-items">
                                    <a href="#" wallet="rabet"><img class=""
                                            src="{{ asset('images/rabet.png') }}"> Rabet</a>
                                </li>
                                <li class="item-drop wallet-drop-items">
                                    <a href="#" wallet="frighter"><img class=""
                                            src="{{ asset('images/frighter.png') }}">Frighter</a>
                                </li>
                                <li class="item-drop wallet-drop-items">
                                    <a href="#" wallet="albeto"><img class=""
                                            src="{{ asset('images/albeto.png') }}">Albedo</a>
                                </li>
                                <li class="item-drop wallet-drop-items">
                                    <a href="#" wallet="xbull"><img class=""
                                            src="{{ asset('images/xbull.png') }}">Xbull</a>
                                </li>
                                <li class="item-drop wallet-drop-items">
                                    <a href="#" wallet="privatekey"><img class=""
                                            src="{{ asset('images/privatekey.png') }}">Private Key</a>
                                </li>
                            </ul>

                            <!-- Alternative to close dropdown with click out -->
                            <label for="target-drop-example" class="overlay-close"></label>

                        </label>
                        <div class="w-100">
                            <div class="input-group-prepend">
                                <input id="walletPrivateKey" style="display: none" type="text" class="form-control"
                                    placeholder="Secret Key">
                            </div>

                            <a onclick="connectWallet()" type="button" class="walletconnect-btn"
                                href="javascript::void()">Connect Wallet</a>
                            <a type="button" style="display:none" class="connectLoading-btn"
                                href="javascript::void()">Connecting... </a>
                        </div>
                        <!-- END -- Dropdown -->
                    </div>
                </div>
            </div>
        </div>
    </div>
