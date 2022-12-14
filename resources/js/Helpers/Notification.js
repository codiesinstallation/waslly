const Noty = require("noty");
class Notification {
    success() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        })
    }
    searchError() {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'لا توجد شحنة بهذا الرقم ',
            showConfirmButton: false,
            timer: 1500
        })
    }
    staus() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'تم تحديث حالة الشحنة',
            showConfirmButton: false,
            timer: 1500
        })
    }
    successMsg(success) {
        Swal.fire({
            type: "success",
            layout: "topRight",
            text: success,
            timeout: 1000,
        }).show();
    }
    navigationAlert() {
        Swal.fire({
            title: "غير مسموح",
            text: "ليس لديك الصلاحية للدخول لهذه الصفحة",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "رجوع !",
            cancelButtonText: "إلغاء",
        });
    }
    alert() {
        new Noty({
            type: "alert",
            layout: "topRight",
            text: "هل أنت متأكد؟!",
            timeout: 1000,
        }).show();
    }

    customMsg(type, dir, msg, time) {
        new Noty({
            type: type ? type : "alert",
            layout: dir,
            text: msg,
            timeout: time ? time : 1000,
        }).show();
    }

    error() {
        new Noty({
            type: "alert",
            layout: "topRight",
            text: "حدث خطأ ما يرجى أعادة المحاولة أو التاكد من العملية غير مرتبطة بأخرى",
            timeout: 1000,
        }).show();
    }
    errorMsg(error) {
        new Noty({
            type: "error",
            layout: "topRight",
            text: error,
            timeout: 1000,
        }).show();
    }
    warning() {
        new Noty({
            type: "warning",
            layout: "topRight",
            text: "خطأ!",
            timeout: 1000,
        }).show();
    }

    image_validation() {
        new Noty({
            type: "error",
            layout: "topRight",
            text: "Upload Image less then 1MB ",
            timeout: 1000,
        }).show();
    }

    cart_success() {
        new Noty({
            type: "success",
            layout: "topRight",
            text: "تم الاضافة بنجاح",
            timeout: 1000,
        }).show();
    }

    cart_delete() {
        new Noty({
            type: "success",
            layout: "topRight",
            text: "تم الحذف بنجاح",
            timeout: 1000,
        }).show();
    }
    item_delete() {
        new Noty({
            type: "success",
            layout: "topRight",
            text: "تم الحذف بنجاح",
            timeout: 1000,
        }).show();
    }
    item_delete_error() {
        new Noty({
            type: "error",
            layout: "topRight",
            text: "لايمكن الحذف",
            timeout: 1000,
        }).show();
    }
    chash_error() {
        new Noty({
            type: "error",
            layout: "topRight",
            text: "النقدية لا تسمح",
            timeout: 1000,
        }).show();
    }
}

export default Notification = new Notification();