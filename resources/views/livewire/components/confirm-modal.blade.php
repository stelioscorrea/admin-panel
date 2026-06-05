<div>
    @if($show)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $title }}</h5>
                        <button type="button" class="btn-close" wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $message }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="close">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-danger" wire:click="confirm">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
