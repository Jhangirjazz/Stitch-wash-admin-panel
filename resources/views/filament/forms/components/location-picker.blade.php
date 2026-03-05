<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
<div
    x-data="locationPicker"
    {{-- x-init="init($refs.map)" --}}
    x-init="$nextTick(() => init($refs.map))"
    data-lat="{{ $getRecord()?->latitude ?? 25.2048 }}"
    data-lng="{{ $getRecord()?->longitude ?? 55.2708 }}"
    wire:ignore
>
    <div x-ref="map" style="height: 400px; width: 100%;"></div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('locationPicker', () => ({
        lat: null,
        lng: null,
        map: null,
        marker: null,
        reverseGeocodeTimeout: null,

        init(mapEl) {
            this.lat = parseFloat(mapEl.parentElement.dataset.lat)
            this.lng = parseFloat(mapEl.parentElement.dataset.lng)

            this.map = L.map(mapEl).setView([this.lat, this.lng], 13)

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(this.map)

            this.marker = L.marker([this.lat, this.lng], {
                draggable: true
            }).addTo(this.map)

            this.marker.on('dragend', (e) => {
                const pos = e.target.getLatLng()
                this.update(pos.lat, pos.lng)
            })

            this.map.on('click', (e) => {
                this.marker.setLatLng(e.latlng)
                this.update(e.latlng.lat, e.latlng.lng)
            })
        },

update(lat, lng) {
    this.lat = lat
    this.lng = lng

    const component = Livewire.find(this.$root.closest('[wire\\:id]').getAttribute('wire:id'))


    // Round to 8 decimal places to match step
    const roundedLat = Math.round(lat * 1e8) / 1e8
    const roundedLng = Math.round(lng * 1e8) / 1e8

    component.set('data.latitude', roundedLat)   // use rounded value
    component.set('data.longitude', roundedLng)  // use rounded value


    clearTimeout(this.reverseGeocodeTimeout)

    this.reverseGeocodeTimeout = setTimeout(() => {
        this.reverseGeocode(lat, lng)
    }, 500)
},
reverseGeocode(lat, lng) {
    const component = Livewire.find(this.$root.closest('[wire\\:id]').getAttribute('wire:id'))

    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`)
        .then(res => res.json())
        .then(data => {
            if (data && data.address) {
                const address = data.address

                component.set('data.address_line1', address.road || '')
                component.set('data.city', address.city || address.town || address.village || '')
                component.set('data.area', address.suburb || address.neighbourhood || '')
                component.set('data.country', 'UAE')
            }
        })
        .catch(error => console.error('Reverse geocoding failed:', error))
}
    }))
})

// document.addEventListener('alpine:init', () => {
//     Alpine.data('locationPicker', () => ({
//         lat: null,
//         lng: null,
//         map: null,
//         marker: null,

//         init(mapEl) {
//             this.lat = parseFloat(mapEl.parentElement.dataset.lat)
//             this.lng = parseFloat(mapEl.parentElement.dataset.lng)

//             this.map = L.map(mapEl).setView([this.lat, this.lng], 13)

//             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                 attribution: '&copy; OpenStreetMap'
//             }).addTo(this.map)

//             this.marker = L.marker([this.lat, this.lng], {
//                 draggable: true
//             }).addTo(this.map)

//             this.marker.on('dragend', (e) => {
//                 const pos = e.target.getLatLng()
//                 this.update(pos.lat, pos.lng)
//             })

//             this.map.on('click', (e) => {
//                 this.marker.setLatLng(e.latlng)
//                 this.update(e.latlng.lat, e.latlng.lng)
//             })
//         },

//         update(lat, lng) {
//             this.lat = lat
//             this.lng = lng

//             $wire.set('data.latitude', lat)
//             $wire.set('data.longitude', lng)
//         }
//     }))
// })
</script>
@endpush

</x-dynamic-component>