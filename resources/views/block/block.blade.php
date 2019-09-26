<div class="col-md-4 mb-3">
    <div class="card">
        <div class="card-header">
            Block {{ $loop->index }}
        </div>
        <div class="card-body">
            <div class="mb-3">
                Hash: <br> {{ $block->hash }}
            </div>
            <div class="mb-3">
                Timestamp: <br> {{ $block->timestamp }}
            </div>
            <div class="mb-3">
                Nonce: <br> {{ $block->nonce }}
            </div>
            <div class="mb-3">
                Prev Hash: <br> {{ $block->prev_hash }}
            </div>
            <div  class="mb-3">
                Data: <br> {{ $block->data }}
            </div>
        </div>
    </div>
</div>