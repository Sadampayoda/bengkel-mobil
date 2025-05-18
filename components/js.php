<script>
    $(document).ready(function() {
        $('#entry').on('change', function() {
            const value = $(this).val();
            const url = new URL(window.location.href);
            const params = url.searchParams;

            params.set('entry', value);

            url.search = params.toString();
            window.location.assign(url.toString());

        })

        $('#add-form').on('click', function() {
            const url = new URL(window.location.href);
            url.search = '';
            window.location.assign(url.toString() + 'create.php');
        })
    })

    const getDataElementAll = (form) => {
        const data = {}
        const input = document.querySelectorAll(`#${form} input`);
        const select = document.querySelectorAll(`#${form} select`)
        input.forEach((item) => {
            data[item.name] = item.value
        })
        select.forEach((item) => {
            data[item.name] = item.value
        })

        return data;
    }

    const deleteData = (eventName, id) => {
        Swal.fire({
            title: "Apakah yakin menghapus data ini?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Yakin",
            denyButtonText: `Tidak jadi`
        }).then((result) => {
            if (result.isConfirmed) {
                if (typeof window[eventName] === 'function') {
                    window[eventName](id);
                } else {
                    console.error(`Function "${eventName}" tidak ditemukan.`);
                }
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        })
    }

    function onDeleteJenis(id) {
        url = window.location.protocol + '//' + window.location.hostname
        const data = {
            id: id
        }
        const fetch = `${url}/bengkel-mobil/app/requests/jenis.php`
        fetchDataAndRedirect({
            urlFetch: fetch,
            method: 'DELETE',
            data: data,
            redirect: `${url}/bengkel-mobil/dashboard/jenis/`
        })

    }

    function onDeleteSatuan(id) {
        url = window.location.protocol + '//' + window.location.hostname
        const data = {
            id: id
        }
        const fetch = `${url}/bengkel-mobil/app/requests/jenis.php`
        fetchDataAndRedirect({
            urlFetch: fetch,
            method: 'DELETE',
            data: data,
            redirect: `${url}/bengkel-mobil/dashboard/satuan/`
        })
    }

    function onDeleteStok(id) {
        url = window.location.protocol + '//' + window.location.hostname
        const data = {
            id: id
        }
        const fetch = `${url}/bengkel-mobil/app/requests/stok.php`
        fetchDataAndRedirect({
            urlFetch: fetch,
            method: 'DELETE',
            data: data,
            redirect: `${url}/bengkel-mobil/dashboard/stok/`
        })
    }

    function onDeleteSupplier(id) {
        url = window.location.protocol + '//' + window.location.hostname
        const data = {
            id: id
        }
        const fetch = `${url}/bengkel-mobil/app/requests/supplier.php`
        fetchDataAndRedirect({
            urlFetch: fetch,
            method: 'DELETE',
            data: data,
            redirect: `${url}/bengkel-mobil/dashboard/supplier/`
        })
    }

    function onDeleteBarangMasuk(id) {
        url = window.location.protocol + '//' + window.location.hostname
        const data = {
            id: id
        }
        const fetch = `${url}/bengkel-mobil/app/requests/barang-masuk.php`
        fetchDataAndRedirect({
            urlFetch: fetch,
            method: 'DELETE',
            data: data,
            redirect: `${url}/bengkel-mobil/dashboard/barang-masuk/`
        })
    }
    
    function onDeleteBarangKeluar(id) {
        url = window.location.protocol + '//' + window.location.hostname
        const data = {
            id: id
        }
        const fetch = `${url}/bengkel-mobil/app/requests/barang-keluar.php`
        fetchDataAndRedirect({
            urlFetch: fetch,
            method: 'DELETE',
            data: data,
            redirect: `${url}/bengkel-mobil/dashboard/barang-keluar/`
        })
    }

    function onDeleteMekanik(id) {
        url = window.location.protocol + '//' + window.location.hostname
        const data = {
            id: id
        }
        const fetch = `${url}/bengkel-mobil/app/requests/mekanik.php`
        fetchDataAndRedirect({
            urlFetch: fetch,
            method: 'DELETE',
            data: data,
            redirect: `${url}/bengkel-mobil/dashboard/mekanik/`
        })
    }

    const fetchDataAndRedirect = (props) => {
        const {
            urlFetch,
            method,
            data,
            notif = 'info',
            redirect
        } = props
        fetch(urlFetch, {
                method: method,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(data).toString()
            })
            .then(response => response.json())
            .then(res => {
                if (res.success) {

                    if (notif == 'info') {
                        Swal.fire({
                            position: "top",
                            icon: "success",
                            title: `${res.message}`,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            window.location.assign(redirect);
                        });
                    }
                } else {
                    Swal.fire({
                        position: "top",
                        icon: "error",
                        title: `${res.message}`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
    }



    const paginate = (page = 1) => {
        const url = new URL(window.location.href);
        const params = url.searchParams;

        params.set('page', page);

        url.search = params.toString();
        window.location.assign(url.toString());
    }

    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');

    }

    const formJenis = (form, method) => {
        const data = {}
        const inputs = document.querySelectorAll(`#${form} input`);
        inputs.forEach((item) => {
            data[item.name] = item.value
        })

        url = window.location.protocol + '//' + window.location.hostname
        const redirectView = data.type == 'satuan' ?
            `${url}/bengkel-mobil/dashboard/satuan/` :
            `${url}/bengkel-mobil/dashboard/jenis/`

        Swal.fire({
            title: "Apakah yakin dengan data ini?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't ssave`
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`${url}/bengkel-mobil/app/requests/jenis.php`, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(data).toString()
                    })
                    .then(response => response.json())
                    .then(res => {
                        if (res.success) {
                            Swal.fire({
                                position: "top",
                                icon: "success",
                                title: `${res.message}`,
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                window.location.assign(redirectView);
                            });
                        }
                    })

            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    }

    const onEditJenis = (id) => {
        url = window.location.protocol + '//' + window.location.hostname + `/bengkel-mobil/dashboard/jenis/create.php?id=${id}`;
        window.location.assign(url);
    }
    const onEditSatuan = (id) => {
        url = window.location.protocol + '//' + window.location.hostname + `/bengkel-mobil/dashboard/satuan/create.php?id=${id}`;
        window.location.assign(url);
    }
    const onEditStok = (id) => {
        url = window.location.protocol + '//' + window.location.hostname + `/bengkel-mobil/dashboard/stok/create.php?id=${id}`;
        window.location.assign(url);
    }
    const onEditSupplier = (id) => {
        url = window.location.protocol + '//' + window.location.hostname + `/bengkel-mobil/dashboard/supplier/create.php?id=${id}`;
        window.location.assign(url);
    }
    const onEditBarangMasuk = (id) => {
        url = window.location.protocol + '//' + window.location.hostname + `/bengkel-mobil/dashboard/barang-masuk/create.php?id=${id}`;
        window.location.assign(url);
    }
    const onEditBarangKeluar = (id) => {
        url = window.location.protocol + '//' + window.location.hostname + `/bengkel-mobil/dashboard/barang-keluar/create.php?id=${id}`;
        window.location.assign(url);
    }
    const onEditMekanik = (id) => {
        url = window.location.protocol + '//' + window.location.hostname + `/bengkel-mobil/dashboard/mekanik/create.php?id=${id}`;
        window.location.assign(url);
    }

    const formStok = (form, method) => {
        const data = getDataElementAll(form);
        url = window.location.protocol + '//' + window.location.hostname
        Swal.fire({
            title: "Apakah yakin dengan data ini?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't ssave`
        }).then((result) => {
            if (result.isConfirmed) {
                fetchDataAndRedirect({
                    urlFetch: url + `/bengkel-mobil/app/requests/stok.php`,
                    method: method,
                    data: data,
                    redirect: url + `/bengkel-mobil/dashboard/stok`,
                })

            }
        })
    }

    const formSupplier = (form, method) => {
        const data = getDataElementAll(form);
        url = window.location.protocol + '//' + window.location.hostname
        Swal.fire({
            title: "Apakah yakin dengan data ini?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't ssave`
        }).then((result) => {
            if (result.isConfirmed) {
                fetchDataAndRedirect({
                    urlFetch: url + `/bengkel-mobil/app/requests/supplier.php`,
                    method: method,
                    data: data,
                    redirect: url + `/bengkel-mobil/dashboard/supplier/`,
                })

            }
        })
    }

    const formBarangMasuk = (form, method) => {
        const data = getDataElementAll(form);
        url = window.location.protocol + '//' + window.location.hostname
        Swal.fire({
            title: "Apakah yakin dengan data ini?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't ssave`
        }).then((result) => {
            if (result.isConfirmed) {
                fetchDataAndRedirect({
                    urlFetch: url + `/bengkel-mobil/app/requests/barang-masuk.php`,
                    method: method,
                    data: data,
                    redirect: url + `/bengkel-mobil/dashboard/barang-masuk/`,
                })

            }
        })
    }

    const formBarangKeluar = (form, method) => {
        const data = getDataElementAll(form);
        url = window.location.protocol + '//' + window.location.hostname
        Swal.fire({
            title: "Apakah yakin dengan data ini?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't ssave`
        }).then((result) => {
            if (result.isConfirmed) {
                fetchDataAndRedirect({
                    urlFetch: url + `/bengkel-mobil/app/requests/barang-keluar.php`,
                    method: method,
                    data: data,
                    redirect: url + `/bengkel-mobil/dashboard/barang-keluar/`,
                })

            }
        })
    }

    const formMekanik = (form, method) => {
        const data = getDataElementAll(form);
        url = window.location.protocol + '//' + window.location.hostname
        Swal.fire({
            title: "Apakah yakin dengan data ini?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't ssave`
        }).then((result) => {
            if (result.isConfirmed) {
                fetchDataAndRedirect({
                    urlFetch: url + `/bengkel-mobil/app/requests/mekanik.php`,
                    method: method,
                    data: data,
                    redirect: url + `/bengkel-mobil/dashboard/mekanik/`,
                })

            }
        })
    }
</script>