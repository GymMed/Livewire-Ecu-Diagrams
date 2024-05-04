@php
    $ecuAttributes = $ecus[0] ? $ecus[0]->getAttributes() : [];
    $totalColumns = count($ecuAttributes);

    $tdClasses = "p-2";
    $mobileValuesClasses = "font-semibold";
@endphp

<div 
    x-data="ecusTableData();"
    class="flex flex-col gap-3"
>
    <div wire:offline>
        You are offline. You need internet to update records!
    </div>

    @if($ecus && count($ecus) > 0)
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <table class="rounded overflow-hidden shadow-lg w-full sm:hidden md:table">
        <thead>
            <tr class="rounded-t font-semibold bg-blue-500 text-white">
                <td class="{{ $tdClasses }}">
                    ID
                </td>
                <td class="{{ $tdClasses }}">
                    Dump ID
                </td>
                <td class="{{ $tdClasses }}">
                    Ecu
                </td>
                <td class="{{ $tdClasses }}">
                    Attribute
                </td>
                <td class="{{ $tdClasses }}">
                    Value
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($ecus as $record)
                <tr 
                    wire:key="{{ $record->id }}"
                    class="border-t hover:bg-blue-200 even:bg-blue-50"
                >
                    <td class="{{ $tdClasses }}" x-html="highlight('{{ $record->id }}', '{{ $search }}')">
                    </td>
                    <td class="{{ $tdClasses }}" x-html="highlight('{{ $record->dump_id }}', '{{ $search }}')">
                    </td>
                    <td class="{{ $tdClasses }}" x-html="highlight('{{ $record->ecu }}', '{{ $search }}')">
                    </td>
                    <td class="{{ $tdClasses }}" x-html="highlight('{{ $record->attribute }}', '{{ $search }}')" >
                    </td>
                    <td class="{{ $tdClasses }}" x-html="highlight('{{ $record->value }}', '{{ $search }}')">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="sm:bock md:hidden">
        <div class="flex flex-col gap-3">
            @foreach ($ecus as $record)
            <div class="flex-col flex gap-1 rounded shadow-inner p-2 bg-gray-100 hover:bg-gradient-to-br hover:from-orange-500 hover:to-orange-700 hover:text-white">
                <div class="flex gap-2 w-full justify-between">
                    <div>ID:</div>
                    <div class="{{ $mobileValuesClasses }}" x-html="highlight('{{ $record->id }}', '{{ $search }}')"></div>
                </div>
                <div class="flex gap-2 w-full justify-between">
                    <div>Dump ID:</div>
                    <div class="{{ $mobileValuesClasses }}" x-html="highlight('{{ $record->dump_id }}', '{{ $search }}')"></div>
                </div>
                <div class="flex gap-2 w-full justify-between">
                    <div>Ecu:</div>
                    <div class="{{ $mobileValuesClasses }}" x-html="highlight('{{ $record->ecu }}', '{{ $search }}')"></div>
                </div>
                <div class="flex gap-2 w-full justify-between">
                    <div>Attribute:</div>
                    <div class="{{ $mobileValuesClasses }}" x-html="highlight('{{ $record->attribute }}', '{{ $search }}')"></div>
                </div>
                <div class="flex gap-2 w-full justify-between">
                    <div>Value:</div>
                    <div class="{{ $mobileValuesClasses }}" x-html="highlight('{{ $record->value }}', '{{ $search }}')"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{ $ecus->onEachSide(1)->links() }}
    @else
    <div class="w-full flex items-center justify-center font-semibold text-lg text-red-500">
        No records found!
    </div>
    @endif
</div>

@push('scripts')
<script>
    function ecusTableData() {
        return {
            highlight (text, term) {
                if (!term) return text;
                const regex = new RegExp(`(${term})`, 'gi');

                return text.replace(regex, '<span class="rounded-md border-2 border-blue-300 text-white bg-gradient-to-br from-blue-500 to-blue-700 px-1 py-0.5">$1</span>');
            }
        };
    }
</script>
@endpush