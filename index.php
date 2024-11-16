<?php
// Include the header
include './public/views/partials/headers.php';
?>

<body>
    <div style="background-color:rgba(118,118,118,.1);height:100vh" class="d-flex justify-content-center w-100 align-items-center">
        <div class="bg-white connexion">
            <div class="w-50 position-relative image-login">
                <img class="position-absolute top-0 w-100 h-100 object-fit-cover" src="./image/logo.webp" alt="#">
            </div>
            <div class="formul">
                <h1 class="font-weight-bolder text-center mt-2 mb-5">AMS Login</h1>
                <!-- <h5 class="font-weight-bold mb-4">Sign In with your credential</h5> -->
                <form class="mt-3 d-flex flex-column gap-3" id="loginForm">
                    <input type="hidden" id="action" name="action" value="check">
                    <!-- <div class="form-group"> -->
                    <!-- <label>Username</label> -->
                    <input name="username" id="username" type="text" placeholder="Username" class="form-control py-4">
                    <!-- </div> -->
                    <!-- <div class="form-group"> -->
                    <!-- <label>Password</label> -->
                    <input name="password" id="password" type="password" placeholder="Password" class="form-control py-4">
                    <!-- </div> -->
                    <div class="d-flex justify-content-between align-items-center" style="font-size: 0.95rem;">
                        <div class="d-flex align-items-center gap-1">
                            <input type="checkbox" class="m-0">
                            <span class="d-flex">Remember&nbsp;me</span>
                        </div>
                        <a href="#">Forget Password</a>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 mt-2 d-flex align-items-center justify-content-center gap-2">
                        <div class="spinner-border d-none spinner-border-sm text-white" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Sign In
                    </button>
                    <!-- <a class="mx-auto" href="#">Sign Up</a> -->
                </form>
            </div>
        </div>
    </div>

    <?php include './public/views/partials/footers.php' ?>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();
                var action = $('#action').val();
                $('.spinner-border').removeClass('d-none')
                $.ajax({
                    url: `./src/controllers/users_controller.php`,
                    method: "POST",
                    data: {
                        username: username,
                        password: password,
                        action: action
                    },
                    success: function(response) {
                        $('.spinner-border').addClass('d-none');
                        const result = JSON.parse(response);
                        // alert(result)
                        console.log(result)
                        if (result.success) {
                            toastr.success(result.message, "Success");
                            location.href = './public/views/dashboard.php';
                        } else {
                            toastr.error(result.message, "Error");
                            // location.href = './index.php';
                        }
                    },
                    error: function() {
                        toastr.error("error", "Error");
                    }
                }, )

                // .catch((error) => {
                //     $('.spinner-border').addClass('d-none');
                //     toastr.error(error);
                // });
            })
        })
    </script>

</body>

</html>