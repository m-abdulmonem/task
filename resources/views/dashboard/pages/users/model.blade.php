<div class="modal fade" id="usersModal" style="display: none;" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="name">Name</label>
                            <input type="text" class="form-control " id="name" placeholder="Name" name="name"
                                   value="{{ old("name") }}" required autocomplete="on">
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="email">Email</label>
                            <input type="email" class="form-control " id="email" placeholder="Email" name="email"
                                   value="{{ old("email") }}" required autocomplete="on">
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="password">Password</label>
                            <input type="password" class="form-control " id="password" placeholder="Password"
                                   name="password"
                                   value="{{ old("password") }}" autocomplete="on">
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="passwordConfirmation">Confirm Password</label>
                            <input type="password" class="form-control " id="passwordConfirmation"
                                   placeholder="Confirm Password" name="password_confirmation"
                                   value="{{ old("password") }}" autocomplete="on">
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="type">User Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select user type</option>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="type">User Status</label>
                            <div class="row " style="justify-content: space-evenly">
                                <div>
                                    <input type="radio" id="active" name="status" value="active">
                                    <label for="active">Active</label>
                                </div>
                                <div>
                                    <input type="radio" id="blocked" name="status" value="blocked">
                                    <label for="blocked">Block</label>
                                </div>
                            </div>
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>

    </div>

</div>

@push("js")
    <script>
        let id, body = $("body"),
            $btnSubmit = $("button[type=submit]"),
            $table = $("#usersTable"),
            $form = $("form"),
            $method = `<input type="hidden" name="_method" value="PUT">`,
            $model = $("#usersModal")


        $form.submit(function (e) {
            e.preventDefault();
            ajax()
            {{--let formData = new FormData(this);--}}

            {{--if ($btnSubmit.data("method") === "put") {--}}
            {{--    const $arr = [];--}}
            {{--    $($(this).serializeArray()).each(function(i, field){--}}
            {{--        $arr[field.name] = field.value;--}}
            {{--    });--}}
            {{--    ajax(`{{ url("dashboard/users") }}/${$btnSubmit.data("id")}`, "put",$arr)--}}
            {{--} else {--}}
            {{--    ajax("{{ route("users.store") }}", "POST", formData)--}}
            {{--}--}}
        })


        body.on("click", ".btn-block-user", function () {
            const $this = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: `You want ${$this.text()} ${$this.data("name")}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: `Yes, ${$this.text()} it!`
            }).then((result) => {
                if (result.isConfirmed) {
                    ajax(`{{ url("dashboard/user/block") }}/${$(this).data("id")}`, "put")
                }
            })
        });

        body.on("click", ".btn-edit-user", function () {
            var data = JSON.parse(JSON.stringify($(this).data("data")));

            $btnSubmit.attr("data-method", "put")
                .attr("data-id", data.id);

            $form.append(`<input type=hidden value=${data.id} name="id" >`)

            for (const [key, value] of Object.entries(data)) {
                if (key !== "deleted_at") {
                    if (key === "type") {
                        $(`#${key} option[value=${value === "admin" ? 1 : 0}]`).attr("selected", true).trigger('change')
                    }
                    if (key === "status") {
                        $(`#${value}`).prop("checked", true);
                    }
                    $(`#${key}`).val(value)
                }
            }

            $model.modal("show");
        });

        function ajax() {
            $.ajax({
                data: $form.serialize(),
                url: "{{ route('users.store') }}",
                type: "POST",
                dataType: 'json',
                // type: method,
                // url: url,
                // data:  method === "put" ? JSON.stringify(data) : data,
                // dataType: "JSON",
                // processData: false,
                // contentType:  method === "put" ? "application/json" :  false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (data) {
                    if (data.status === 1) {
                        Swal.fire(
                            'Congratulation',
                            data.msg,
                            'success'
                        )
                        if ($btnSubmit.data("method") === "put") {
                            $btnSubmit.removeAttr("data-method");
                            $("input[name=_method]").remove();
                        }
                        $model.modal("hide");
                        $table.DataTable().draw();
                        $form[0].reset();
                        $form.trigger("reset");
                        $(".alert").addClass("d-none")
                    }
                },
                error: function (data, textStatus, jqXHR) {
                    const response = data.responseJSON;
                    console.log(response)
                    if (response) {
                        for (const [key, value] of Object.entries(response.errors)) {
                            $(`#${key}`)
                                .addClass("is-invalid")
                                .parent()
                                .find(".alert")
                                .removeClass("d-none")
                                .text(value[0])
                                .show()
                        }
                    }
                },
            });
        }
    </script>
@endpush
