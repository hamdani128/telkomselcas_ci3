function login_system() {
    var username = $("#username").val();
    var password = $("#password").val();
    if (username == '' || password == '') {
        Swal.fire({
            title: "Warning",
            text: "Username dan Password Tidak Boleh Kosong !",
            icon: "warning",
        });
    } else {
        $.ajax({
            url: "../panel/login.php?aksi=logincheck",
            type: "POST",
            data: {
                username: username,
                password: password,
            },
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    Swal.fire({
                        title: "Weldone !",
                        text: " Anda Berhasil Login !",
                        icon: "success",
                    }).then((result) => {
                        if (result.value) {
                            document.location = "../pages/home";
                        }
                    });
                    // Swal.fire({
                    //     // icon: 'success',
                    //     imageUrl: "../assets/images/Logo-3.png",
                    //     imageWidth: 100,
                    //     imageHeight: 100,
                    //     imageAlt: "Custom image",
                    //     title: 'Login Anda Berhasil !' + ' Selamat Datang Di Campaign Analytic',
                    //     text: " This system is for the use of Telkomsel authorized users only. " +
                    //         "Individuals using this computer system without authority, or in " +
                    //         "excess of their authority,are subject to having all of their " +
                    //         "activities on this system monitored and recorded by system  " +
                    //         "personnel. In the course of monitoring individuals improperly using this " +
                    //         "system, or in the course of system maintenance," +
                    //         "the activities of authorized users may also be monitored. " +
                    //         "Anyone using this system expressly consents to such monitoring and is advised that " +
                    //         "if such monitoring reveals possible evidence of criminal activity," +
                    //         "system personnel may provide the evidence of such monitoring to law enforcement officials",
                    // }).then((result) => {
                    //     if (result.value) {
                    //         document.location = "../pages/home";
                    //     }
                    // });
                } else {
                    Swal.fire({
                        title: "Warning",
                        text: "Username atau Password Salah !",
                        icon: "warning",
                    });
                }
            }
        }
        );
    }

}


