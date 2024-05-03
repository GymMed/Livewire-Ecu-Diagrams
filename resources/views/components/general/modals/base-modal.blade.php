@props([
    'id' => ''
])

<dialog
    x-data="dialogModalData('{{ $id ? $id : '' }}');"
    x-on:show-modal.window="showModal(event);"
    x-on:close-modal.window="closeModal(event);"
    @click="clickModal(event);"
    x-ref="dialogWindow"
    class="rounded-lg shadow-lg w-8/12"
>
    <div class="p-3 rounded-lg shadow-lg flex flex-col gap-2">
        {{ $slot }} 

        <div class="flex justify-end">
            <button
                type="button"
                class="text-white font-semibold bg-gradient-to-br from-red-500 to-red-700 hover:from-red-700 hover:to-red-900 rounded"
                @click="closeModal(event);"
            >
                <div class="hover:scale-110 px-4 py-1">Close</div>
            </button>
        </div>
    </div>
</dialog>

@push('scripts')
<script>
    function dialogModalData (id) {
        return {
            id: id,
            showModal(event) {
                if(!event.detail.id || this.id !== event.detail.id)
                    return;

                this.$refs.dialogWindow.showModal();
            },
            closeModal(event) {
                this.$refs.dialogWindow.close();
            },
            clickModal(event) {
                if (event.target === this.$refs.dialogWindow) {
                    this.$refs.dialogWindow.close();
                }
            },
        };
    };
</script>
@endpush