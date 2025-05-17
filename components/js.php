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
        const data = {id:id}
        fetch(`${url}/bengkel-mobil/app/requests/jenis.php`, {
                method: 'DELETE',
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
                        const redirect = `${url}/bengkel-mobil/dashboard/jenis/`
                        window.location.assign(redirect);
                    });
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
        const inputs = document.querySelectorAll(`#${form} input, select`);
        inputs.forEach((item) => {
            data[item.name] = item.value
        })

        url = window.location.protocol + '//' + window.location.hostname


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
                                const redirect = `${url}/bengkel-mobil/dashboard/jenis/`
                                window.location.assign(redirect);
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
</script>