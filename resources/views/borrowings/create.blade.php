<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span>Peminjaman</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Buat</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Catat Peminjaman Barang
                </h2>
            </div>
            <a href="{{ route('borrowings.index') }}"
                class="inline-flex items-center gap-2 bg-white dark:bg-[#1e1f20] hover:bg-gray-50 dark:hover:bg-zinc-800 text-gray-700 dark:text-zinc-300 font-bold py-2 px-4 rounded-xl text-sm border border-gray-200 dark:border-zinc-700 shadow-sm transition transform active:scale-95 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 p-8">
                <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="user_id"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Personil
                            Penanggung Jawab</label>
                        <select id="user_id" name="user_id" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm">
                            <option value="">Pilih Nama Anggota...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role?->name ?? 'Staff' }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-1" />
                    </div>

                    <div>
                        <label for="waktu_pinjam"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Tanggal
                            & Waktu Pengambilan</label>
                        <input id="waktu_pinjam" name="waktu_pinjam" type="datetime-local" required
                            value="{{ date('Y-m-d\TH:i') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm" />
                        <x-input-error :messages="$errors->get('waktu_pinjam')" class="mt-1" />
                    </div>

                    <div class="border-t border-gray-100 dark:border-zinc-800 pt-5 space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">
                            Pemilihan Unit Logistik</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="category_filter"
                                    class="block text-xs font-semibold text-gray-500 dark:text-zinc-400 mb-1.5">Klasifikasi
                                    Kategori</label>
                                <select id="category_filter"
                                    class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition">
                                    <option value="">Pilih Kelompok Kategori...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="instance_select"
                                    class="block text-xs font-semibold text-gray-500 dark:text-zinc-400 mb-1.5">Daftar
                                    Unit Tersedia</label>
                                <select id="instance_select"
                                    class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition disabled:opacity-50"
                                    disabled>
                                    <option value="">Pilih kategori terlebih dahulu...</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" id="add_item_btn"
                                class="bg-gray-900 dark:bg-zinc-700 hover:bg-gray-800 dark:hover:bg-zinc-600 text-white font-bold py-1.5 px-4 rounded-lg text-xs transition active:scale-95">
                                + Masukkan ke Daftar Keranjang
                            </button>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-[#131314]/40 rounded-2xl p-5 border border-gray-100 dark:border-zinc-800/80">
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-3">Unit
                            Yang Akan Dipinjam (Multi-Item)</label>
                        <div id="selected_items_container" class="space-y-2 text-sm text-gray-400 dark:text-zinc-500">
                            Keranjang pinjaman masih kosong.
                        </div>
                        <x-input-error :messages="$errors->get('instance_ids')" class="mt-2" />
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-xl text-sm transition transform active:scale-95 shadow-md shadow-indigo-100 dark:shadow-none">
                            Simpan Log & Kunci Status Pinjam
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const categorySelect = document.getElementById('category_filter');
                const instanceSelect = document.getElementById('instance_select');
                const addItemBtn = document.getElementById('add_item_btn');
                const container = document.getElementById('selected_items_container');
                let addedIds = [];

                categorySelect.addEventListener('change', function () {
                    const catId = this.value;
                    if (!catId) {
                        instanceSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu...</option>';
                        instanceSelect.disabled = true;
                        return;
                    }

                    instanceSelect.disabled = true;
                    instanceSelect.innerHTML = '<option value="">Sedang memuat data...</option>';
                    let apiUrl = "{{ url('/api/v1/categories') }}/" + catId + "/instances";

                    fetch(apiUrl)
                        .then(response => response.json())
                        .then(res => {
                            instanceSelect.innerHTML = '<option value="">Pilih Unit Fisik Alat...</option>';
                            if (!res.data || res.data.length === 0) {
                                instanceSelect.innerHTML = '<option value="">Tidak ada unit tersedia saat ini</option>';
                            } else {
                                res.data.forEach(item => {
                                    if (!addedIds.includes(item.id)) {
                                        instanceSelect.innerHTML += `<option value="${item.id}" data-text="${item.product.nama_barang} (${item.kode_unik})">${item.product.nama_barang} [${item.kode_unik}] - Kondisi: ${item.kondisi_barang}</option>`;
                                    }
                                });
                            }
                            instanceSelect.disabled = false;
                        })
                        .catch(error => {
                            instanceSelect.innerHTML = '<option value="">Gagal memuat data alat</option>';
                        });
                });

                addItemBtn.addEventListener('click', function () {
                    const selectedOption = instanceSelect.options[instanceSelect.selectedIndex];
                    if (!instanceSelect.value || !selectedOption.value) return;

                    if (addedIds.length === 0) {
                        container.innerHTML = '';
                    }

                    const id = instanceSelect.value;
                    const text = selectedOption.getAttribute('data-text');
                    addedIds.push(parseInt(id));

                    const itemRow = document.createElement('div');
                    itemRow.className = 'flex justify-between items-center bg-white dark:bg-[#131314] px-4 py-2.5 rounded-xl border border-gray-200/80 dark:border-zinc-800/80 shadow-sm';
                    itemRow.id = `row_${id}`;
                    itemRow.innerHTML = `
                            <span class="text-sm font-medium text-gray-800 dark:text-zinc-200">• ${text}</span>
                            <input type="hidden" name="instance_ids[]" value="${id}">
                            <button type="button" class="text-xs font-bold text-red-500 hover:text-red-700" onclick="removeSelectedRow(${id})">Hapus</button>
                        `;

                    container.appendChild(itemRow);
                    selectedOption.remove();
                    instanceSelect.value = '';
                });

                window.removeSelectedRow = function (id) {
                    const element = document.getElementById(`row_${id}`);
                    if (element) element.remove();
                    addedIds = addedIds.filter(item => item !== id);
                    if (addedIds.length === 0) {
                        container.innerHTML = 'Keranjang pinjaman masih kosong.';
                    }
                    categorySelect.dispatchEvent(new Event('change'));
                }
            });
        </script>
    @endpush
</x-app-layout>