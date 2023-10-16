<?php  if ($session_rol != "invitado" and $session_rol != "cliente" and $session_rol != "proveedor" ) {?>
<?php include '../assets/controlador/proyectos.php'?>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <div id="kt_header" class="header">
                <div class="container-fluid d-flex flex-stack">
                    <div class="d-flex align-items-center me-5">
                        <div class="d-lg-none btn btn-icon btn-active-color-white w-30px h-30px ms-n2 me-3"
                            id="kt_aside_toggle">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <a href="panel/index.php">
                            <img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-25px h-lg-30px" />
                        </a>
                    </div>
                    <div class="d-flex align-items-center flex-shrink-0">
                        <div class="d-flex align-items-center ms-1">
                            <div class="btn btn-icon btn-color-white bg-hover-white bg-hover-opacity-10 w-30px h-30px h-40px w-40px"
                                id="kt_activities_toggle">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                                        <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                            fill="currentColor" />
                                        <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                                        <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <?php include_once '../assets/controlador/header.php'?>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column-fluid">

                <?php include_once 'menu-proyectos.php'?>

                <div class="d-flex flex-column flex-column-fluid container-fluid">
                    <div class="toolbar mb-2 mb-lg-2" id="kt_toolbar">
                        <div class="page-title d-flex flex-column me-3 mb-1">
                            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Proyectos</h1>
                        </div>
                    </div>
                    <div class="content flex-column-fluid" id="kt_content">
                        <div class="card">
                            <div class="card-body py-4">
                                <?php include_once 'tabla-proyectos.php'?>
                            </div>
                        </div>
                    </div>
                    <div class="footer py-4 d-flex flex-column flex-md-row flex-stack" id="kt_footer">
                        <?php include_once 'footer-proyectos.php'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form class="form" method="POST" enctype="multipart/form-data">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Set First Target</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                            <a href="#" class="fw-bolder link-primary">Project Guidelines</a>.
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Target Title</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Specify a target name for future usage and reference"></i>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Target Title"
                            name="target_title" />
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Assign</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Select a Team Member" name="target_assign">
                                <option value="">Select user...</option>
                                <option value="1">Karina Clark</option>
                                <option value="2">Robert Doe</option>
                                <option value="3">Niel Owen</option>
                                <option value="4">Olivia Wild</option>
                                <option value="5">Sean Bean</option>
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Due Date</label>
                            <div class="position-relative d-flex align-items-center">
                                <span class="svg-icon svg-icon-2 position-absolute mx-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                            fill="currentColor" />
                                        <path
                                            d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                            fill="currentColor" />
                                        <path
                                            d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date"
                                    name="due_date" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Target Details</label>
                        <textarea class="form-control form-control-solid" rows="3" name="target_details"
                            placeholder="Type Target Details"></textarea>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Tags</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Specify a target priorty"></i>
                        </label>
                        <input class="form-control form-control-solid" value="Important, Urgent" id="equipo" name="equipo" />
                    </div>
                    <div class="d-flex flex-stack mb-8">
                        <div class="me-5">
                            <label class="fs-6 fw-bold">Adding Users by Team Members</label>
                            <div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning
                            </div>
                        </div>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                            <span class="form-check-label fw-bold text-muted">Allowed</span>
                        </label>
                    </div>
                    <div class="mb-15 fv-row">
                        <div class="d-flex flex-stack">
                            <div class="fw-bold me-5">
                                <label class="fs-6">Notifications</label>
                                <div class="fs-7 text-muted">Allow Notifications by Phone or Email</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <label class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" name="communication[]"
                                        value="email" checked="checked" />
                                    <span class="form-check-label fw-bold">Email</span>
                                </label>
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" name="communication[]"
                                        value="phone" />
                                    <span class="form-check-label fw-bold">Phone</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Registrar Usuario</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary modal-close" data-kt-users-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form class="form" method="POST" enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-4">
                            <label class="d-block fw-bold fs-6 mb-5">Avatar</label>
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('assets/media/avatars/blank.png')">
                                <div class="image-input-wrapper w-125px h-125px" id="editImagen"
                                    style="background-image: url(assets/media/avatars/blank.png);"></div>
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imagen">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="imagen" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                            </div>
                            <div class="form-text">Archivos permitidos: png, jpg, jpeg.</div>
                        </div>
                        <div class="row fv-row mb-4">
                            <div class="col-xl-6">
                                <label class="required form-label fw-bold mb-2 fs-6">Nombres</label>
                                <input type="text" name="crearNombres"
                                    class="form-control form-control-solid mb-3 mb-lg-0" id="crearNombres" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fw-bold mb-2 fs-6">Apellidos</label>
                                <input type="text" name="crearApellidos"
                                    class="form-control form-control-solid mb-3 mb-lg-0" id="crearApellidos" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fw-bold mb-2 fs-6">Número</label>
                                <input type="text" name="crearNumero"
                                    class="form-control form-control-solid mb-3 mb-lg-0" id="crearNumero" required />
                            </div>
                            <div class="col-xl-6">
                                <label class="required form-label fw-bold mb-2 fs-6">Dirección</label>
                                <input type="text" name="crearDireccion"
                                    class="form-control form-control-solid mb-3 mb-lg-0" id="crearDireccion" required />
                            </div>
                        </div>
                        <div class="fv-row mb-4">
                            <label class="required fw-bold fs-6 mb-2">Email</label>
                            <input type="email" name="crearEmail" class="form-control form-control-solid mb-3 mb-lg-0"
                                id="crearEmail" required />
                            <input type="text" name="crearPassword" value="User1234."
                                class="form-control form-control-solid mb-3 mb-lg-0" id="crearPassword" hidden />
                        </div>
                    </div>
                    <div class="text-center pt-6">


                        <button class="btn btn-light me-3 modal-close">Cancelar</button>
                        <button type="submit" class="btn btn-success" name="btncrear" value="crearU">
                            <span class="indicator-label">Guardar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
</div>
<?php } else{
header("location: ../panel/index.php");
} ?>