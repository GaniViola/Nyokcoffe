<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL; ?>/profil.css">
</head>

<body>
    <div class="container mt-5">
        <h4>Account Settings</h4>
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="tab"
                            href="#account-general">Informasi Umum</a>
                        <a class="list-group-item list-group-item-action" data-toggle="tab"
                            href="#account-change-password">Ubah Password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <!-- Tab Informasi Umum -->
                        <div class="tab-pane fade show active" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""
                                    class="d-block rounded-circle" style="width: 100px; height: 100px;">
                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                        Upload New Photo
                                        <input type="file" class="account-settings-fileinput" hidden>
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default">Reset</button>
                                    <div class="text-light small mt-1">Allowed JPG, GIF, or PNG. Max size of 800K</div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" value="nmaxwell">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No Telepon</label>
                                    <input type="text" class="form-control" value="08123456789">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="nmaxwell@mail.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" class="form-control" value="Company Ltd.">
                                </div>
                            </div>
                        </div>
                        <!-- Tab Ubah Password -->
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" id="oldPassword" class="form-control">
                                        <button type="button" class="toggle-password" data-target="#oldPassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" id="newPassword" class="form-control">
                                        <button type="button" class="toggle-password" data-target="#newPassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" id="confirmPassword" class="form-control">
                                        <button type="button" class="toggle-password" data-target="#confirmPassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3">
            <button type="button" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-default">Cancel</button>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle visibility for password fields
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const targetInput = document.querySelector(this.dataset.target);
                const icon = this.querySelector('i');
                if (targetInput.type === 'password') {
                    targetInput.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    targetInput.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
    </script>
</body>

</html>
