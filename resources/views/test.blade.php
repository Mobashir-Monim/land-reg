@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12" id="blocks-container">
            <div class="row mb-3" id="row-0">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Block 0
                        </div>
                        <div class="card-body" id="block-0">
                            Hash:
                            <div class="mb-3" id="hash-0">
                                
                            </div>
                            <div class="mb-3" id="timestamp-0">
                                Timestamp: <br>
                            </div>
                            {{-- <div class="mb-3" id="nonce-0">
                                Nonce: <br>
                            </div> --}}
                            <div class="mb-3" id="prev-hash-0">
                                Prev Hash: <br>
                            </div>
                            <div  class="mb-3"id="data-0">
                                Data:
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Add Block
                </div>
                <div class="card-body">
                    {{-- <input type="text" name="block_data" class="form-control textarea mb-3" placeholder="Block Data"> --}}
                    <textarea name="block_data" class="form-control mb-3" placeholder="Block Data" id="block_data"></textarea>
                    <input type="text" name="upper_limit" id="upper_limit" class="form-control mb-3" placeholder="Upper Limit">
                    <button class="btn btn-success w-100" onclick="addBlock()">Add Block</button>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection

@section('scripts')
    <script>
        let rowCount = 0;
        let blkCount = 0;
        let rowCreateBool = false;

        window.onload = () => {
            let timestamp = new Date();
            document.getElementById('timestamp-0').innerText = document.getElementById('timestamp-0').innerText + timestamp;
            let data = {
                'timestamp': timestamp,
                'prev_hash': null,
                'nonce': null,
                'data': null,
            };

            let hashVal = hash(data);

            hashVal.then(function (val) {
                document.getElementById('hash-0').innerText = document.getElementById('hash-0').innerText + val;
            });

            blkCount++;
        }

        // will add block
        const addBlock = () => {
            let timestamp = new Date();
            let info = {
                'timestamp': timestamp,
                'prev_hash': document.getElementById('hash-'+(blkCount - 1)).innerText,
                'nonce': 0,
                'data': document.getElementById('block_data').value,
                'starting': document.getElementById('upper_limit').value,
            };

            let row = getRow();
            let col = addCol(info);
            row.appendChild(col);

            if (rowCreateBool) {
                document.getElementById('blocks-container').appendChild(row);
            }

            blkCount++;
        }

        // will add row
        const getRow = () => {
            let row = document.getElementById('row-'+rowCount);
            rowCreateBool = false;

            if (blkCount % 3 == 0) {
                rowCount++;
                row = document.createElement('div');
                row.classList.add('row', 'mb-3');
                row.id = 'row-'+rowCount;
                rowCreateBool = true;
            }

            return row;
        }

        // will add col
        const addCol = (info) => {
            let col = document.createElement('div');
            col.classList.add('col-md-4', 'mb-3');
            let card = addCard(info);

            col.appendChild(card);

            return col;
        }

        const addCard = (info) => {
            let card = document.createElement('div');
            let cardH = document.createElement('div');
            let cardB = document.createElement('div');

            card.classList.add('card');
            cardH.classList.add('card-header');
            cardB.classList.add('card-body');
            cardB.id = 'block-'+blkCount;

            cardH.innerText = 'Block '+blkCount;
            cardB.innerText = 'Hash:';
            cardB.appendChild(addHashDiv(info));
            cardB.appendChild(addTimeDiv(info.timestamp));
            // cardB.appendChild(addNonceDiv(info.nonce));
            cardB.appendChild(addPHashDiv(info.prev_hash));
            cardB.appendChild(addDataDiv(info.data));

            card.appendChild(cardH);
            card.appendChild(cardB);

            return card;
        }

        const addHashDiv = (info) => {
            let div = document.createElement('div');
            div.id = 'hash-'+blkCount;
            div.classList.add('mb-3');
            let hashVal = hash(info);

            // while (!checkStatus(hashVal, info.starting)) {
            //     info.nonce++;
            //     console.log(info.nonce);
            // }

            hashVal.then(function (val) {
                div.innerText = val;
            });

            return div;
        }

        const checkStatus = (hashVal, starting) => {
            hashVal.then(function (val) {
                if (val.startsWith(starting)) {
                    return true;
                }

                return false;
            });
        }

        const addTimeDiv = (timestamp) => {
            let div = document.createElement('div');
            div.id = 'timestamp-'+blkCount;
            div.classList.add('mb-3');
            div.innerText = "Timestamp: ";
            let p = document.createElement('div');
            p.innerText = timestamp;
            div.appendChild(p);

            return div;
        }

        const addNonceDiv = (nonce) => {
            let div = document.createElement('div');
            div.id = 'nonce-'+blkCount;
            div.classList.add('mb-3');
            div.innerText = "Nonce: "
            let p = document.createElement('div');
            p.innerText = (nonce == 0 ? '' : nonce);
            div.appendChild(p);

            return div;
        }

        const addPHashDiv = (pHash) => {
            let div = document.createElement('div');
            div.id = 'prev-hash-'+blkCount;
            div.classList.add('mb-3');
            div.innerText = "Prev Hash: ";
            let p = document.createElement('div');
            p.innerText = pHash;
            div.appendChild(p);

            return div;
        }

        const addDataDiv = (data) => {
            let div = document.createElement('div');
            div.id = 'data-'+blkCount;
            div.classList.add('mb-3');
            div.innerText = "Data: "
            let p = document.createElement('div');
            p.innerText = data;
            div.appendChild(p);

            return div;
        }

        const hash = async (data) => {
            let info = data.timestamp+' '+data.prev_hash+' '+data.nonce+' '+data.data;
            // encode as UTF-8
            const msgBuffer = new TextEncoder('utf-8').encode(info);

            // hash the message
            const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);

            // convert ArrayBuffer to Array
            const hashArray = Array.from(new Uint8Array(hashBuffer));

            // convert bytes to hex string
            const hashHex = hashArray.map(b => ('00' + b.toString(16)).slice(-2)).join('');
            
            return hashHex;
        }
    </script>
@endsection