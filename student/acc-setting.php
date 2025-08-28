<?php
    session_start();
    include('../includes/dbconn.php');
    date_default_timezone_set('America/Chicago');
    include('../includes/check-login.php');
    check_login();
    $ai=$_SESSION['id'];
    // code for change password
    if(isset($_POST['changepwd'])){
        $op=$_POST['oldpassword'];
        $op=md5($op);
        $np=$_POST['newpassword'];
        $np=md5($np);
        $udate=date('d-m-Y h:i:s', time());;
        $sql="SELECT password FROM userregistration where password=?";
        $chngpwd = $mysqli->prepare($sql);
        $chngpwd->bind_param('s',$op);
        $chngpwd->execute();
        $chngpwd->store_result(); 
        $row_cnt=$chngpwd->num_rows;;
        if($row_cnt>0){
            $con="update userregistration set password=?,passUdateDate=?  where id=?";
            $chngpwd1 = $mysqli->prepare($con);
            $chngpwd1->bind_param('ssi',$np,$udate,$ai);
            $chngpwd1->execute();
            $_SESSION['msg']="Password has been updated !!";
        } else {
            $_SESSION['msg']="Old Password does not match !!";
        }	

    }


    $userId = $_SESSION['id'];
    $passportImg = '';
    $stmt = $mysqli->prepare("SELECT passport FROM userregistration WHERE id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($passportData);
    if ($stmt->fetch() && !empty($passportData)) {
        $passportImg = 'data:image/jpeg;base64,' . base64_encode($passportData);
    }
    $stmt->close();

    function checkFileSizeAgainstMaxAllowedPacket($mysqli, $fileSize) {
        $result = $mysqli->query("SHOW VARIABLES LIKE 'max_allowed_packet'");
        $row = $result->fetch_assoc();
        $maxAllowedPacket = isset($row['Value']) ? (int)$row['Value'] : 1048576; // default 1MB if not found
        if ($fileSize > $maxAllowedPacket) {
            echo '<script>alert("File too large. Maximum size allowed is " + Math.round(' . $maxAllowedPacket . ' / 1048576) + "MB."); window.history.back();</script>';
            return false;
        }
        return true;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['passport'])) {
        // Check for upload errors first
        if ($_FILES['passport']['error'] === UPLOAD_ERR_INI_SIZE || $_FILES['passport']['error'] === UPLOAD_ERR_FORM_SIZE) {
            echo '<script>alert("File too large. Maximum allowed size is 2MB.");</script>';
            exit;
        }
        if ($_FILES['passport']['error'] !== UPLOAD_ERR_OK) {
            echo '<script>alert("File upload error. Please try again.");</script>';
            exit;
        }
        // Check for valid file size and valid tmp_name
        if ($_FILES['passport']['size'] > 2 * 1024 * 1024 || empty($_FILES['passport']['tmp_name']) || !is_uploaded_file($_FILES['passport']['tmp_name'])) {
            echo '<script>alert("File too large or invalid. Maximum allowed size is 2MB.");</script>';
            exit;
        }
        $fileSize = $_FILES['passport']['size'];
        if (!checkFileSizeAgainstMaxAllowedPacket($mysqli, $fileSize)) {
            exit;
        }
        // Only process if file is valid
        $passportData = file_get_contents($_FILES['passport']['tmp_name']);
        $passportEscaped = $mysqli->real_escape_string($passportData);
        $userId = $_SESSION['id'];
        $query = "UPDATE userregistration SET passport='$passportEscaped' WHERE id='$userId'";
        if ($mysqli->query($query)) {
            $_SESSION['passport_uploaded'] = true;
            header("Location: acc-setting.php");
            exit;
        } else {
            echo '<script>alert("Error uploading passport: ' . $mysqli->error . '");</script>';
        }
    }

    // Show alert only if flag is set
    if (isset($_SESSION['passport_uploaded'])) {
        echo '<script>alert("Passport uploaded successfully!");</script>';
        unset($_SESSION['passport_uploaded']);
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script type="text/javascript">
    function valid(){
    if(document.changepwd.newpassword.value!= document.changepwd.cpassword.value){
        alert("New Password and Confirmation Password does not match");
        document.changepwd.cpassword.focus();
        return false;
     }
        return true;
    }
    </script>
    
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <?php include '../includes/student-navigation.php'?>
        </header>
        <!-- By CodeAstro - codeastro.com -->
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/student-sidebar.php'?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Account Settings - Change Password</h4>
                </div>

                <div class="row">
                    <?php $result ="SELECT passUdateDate FROM userregistration WHERE id=?";
                        $stmt = $mysqli->prepare($result);
                        $stmt->bind_param('i',$ai);
                        $stmt->execute();
                        $stmt -> bind_result($result);
                        $stmt -> fetch(); 
                    ?>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle">Last Updated On: <code><?php echo $result; ?></code> </h6>
                            </div>
                        </div>
                    </div>
                </div>


                <?php if(isset($_POST['changepwd'])){ ?>
                        <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                                    role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Info: </strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?>
                        </div> <?php } 
                ?>

                <form method="POST" name="changepwd" id="change-pwd" onSubmit="return valid();">
                    <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Current Password</h4>
                                            <div class="form-group">
                                                <input type="password" name="oldpassword" id="oldpassword" value="" class="form-control" onBlur="checkpass()" required="required">
                                                <span id="password-availability-status" class="help-block m-b-none" style="font-size:12px;"></span>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">New Password</h4>
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="newpassword" id="newpassword" value="" required="required">
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Confirm Password<h4>
                                            <div class="form-group">
                                                <input type="password" class="form-control" value="" required="required" id="cpassword" name="cpassword">
                                            </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="changepwd" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>
                </form>

                <form id="acc-settings-form" method="POST" enctype="multipart/form-data" style="margin-top:40px;margin-bottom:10px;">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Passport Photograph</h4>
                                        <div class="form-group">
                                            <label for="passport">Passport Photograph</label>
                                            <div style="margin-top:10px;margin-bottom:10px;">
                                                <img id="passport-preview" src="<?php echo $passportImg; ?>" alt="Passport Preview" style="max-width:120px;max-height:120px;border-radius:8px;display:<?php echo $passportImg ? 'block' : 'none'; ?>;">
                                            </div>
                                            <input type="file" name="passport" id="passport" accept="image/*" class="form-control" onchange="previewPassport(event)" maxlength="2097152">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="upload_passport" class="btn btn-success">Submit Passport</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include '../includes/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!-- customs -->

    <script>
        function checkpass() {
            $("#loaderIcon").show();
            jQuery.ajax({
            url: "check-availability.php",
            data:'oldpassword='+$("#oldpassword").val(),
            type: "POST",
            success:function(data){
                $("#password-availability-status").html(data);
                $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }

        function previewPassport(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('passport-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
        
    </script>
</body>

</html>