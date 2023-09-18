$(document).ready(function () {
  $("#user_check").change(function () {
    if ($(this).is(":checked")) {
      localStorage.setItem("user_check", true);
    } else {
      localStorage.removeItem("user_check");
    }
  });
  $("#pass_check").change(function () {
    if ($(this).is(":checked")) {
      localStorage.setItem("pass_check", true);
    } else {
      localStorage.removeItem("pass_check");
    }
  });

  const userChecked = localStorage.getItem("user_check");
  const passChecked = localStorage.getItem("pass_check");

  if (userChecked === "true") {
    $("#user_check").prop("checked", true);
  }
  if (passChecked === "true") {
    $("#pass_check").prop("checked", true);
  }
});
// navbar effects

staff = document.getElementById("staff");
home = document.getElementById("home");
manage = document.getElementById("manage");
transaction = document.getElementById("transaction");
dashboard = document.getElementById("dashboard");

$(".nav-link").click(function () {
  currentDataAttr = event.target.getAttribute("data-showName");
  window.localStorage.setItem("dataAttr", currentDataAttr);
});

$(document).ready(function () {
  currentDataAttr = window.localStorage.getItem("dataAttr");
  if (currentDataAttr === "bg-gradient-primary0") {
    staff.classList.add(currentDataAttr);
  } else if (currentDataAttr === "bg-gradient-primary1") {
    home.classList.add(currentDataAttr);
  } else if (currentDataAttr === "bg-gradient-primary2") {
    manage.classList.add(currentDataAttr);
  } else if (currentDataAttr === "bg-gradient-primary3") {
    transaction.classList.add(currentDataAttr);
  } else if (currentDataAttr === "bg-gradient-primary6") {
    dashboard.classList.add(currentDataAttr);
  }
});

/**Logout */
$(".logout").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    type: "warning",
    icon: "warning",
    title: "Are You Sure?",
    text: "You will be logout",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Logout",
    customClass: {
      actions: "my-actions",
      cancelButton: "order-1 right-gap",
      confirmButton: "order-2",
      container: "my-swal",
    },
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

/**Remove*/
$(".remove").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    type: "warning",
    icon: "warning",
    title: "Are You Sure?",
    text: "Animal will be remove",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Remove",
    customClass: {
      actions: "my-actions",
      cancelButton: "order-1 right-gap",
      confirmButton: "order-2",
      container: "my-swal",
    },
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

/**Logout */

/**Datatables */
$(document).ready(function () {
  $("#example").DataTable();
});

/**Fafa eye */
function currentpass() {
  var x = document.getElementById("currentpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function newpass() {
  var x = document.getElementById("newpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function newpassword() {
  var x = document.getElementById("newpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function password() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function confirmpassword() {
  var x = document.getElementById("confirmpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function confirmnewpassword() {
  var x = document.getElementById("confirmnewpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function confirmnewpass() {
  var x = document.getElementById("confirmnewpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

/**Delete User */
$(".deleteuser").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    type: "warning",
    icon: "warning",
    title: "Are You Sure?",
    text: "User will be deleted",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Delete User",
    customClass: {
      actions: "my-actions",
      cancelButton: "order-1 right-gap",
      confirmButton: "order-2",
    },
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

/**Success Message */
function msg() {
  swal.fire({
    title: "Welcome" + " " + title,
    text: message,
    icon: "success",
  });
}

function success() {
  swal.fire({
    title: "Success",
    text: messagesuccess,
    icon: "success",
  });
}

function failed() {
  swal.fire({
    title: "Failed",
    text: messagefailed,
    icon: "warning",
  });
}
/**Generate Report */
function printCertificate() {
  const printContents = document.getElementById("pdf").innerHTML;
  const originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}
// $(".sm-download").on("click", function () {
//   alert("Yow");
// });
function CreatePDFfromHTML() {
  const yow = document.getElementById("pdf-sm");
  yow.style.display = "block";

  const HTML_Width = 612; // 8.5in x 72pt/in = 612pt
  const HTML_Height = 792; // 11in x 72pt/in = 792pt
  const top_left_margin = 10;
  const PDF_Width = HTML_Width + top_left_margin * 2;
  const PDF_Height = PDF_Width * 1.4142;
  const canvas_image_width = 1224; // 2 x 612
  const canvas_image_height = 1224; // 2 x 792

  const totalPDFPages = Math.ceil(HTML_Height / PDF_Height);

  html2canvas($("#pdf")[0], { scale: 2 }).then(function (canvas) {
    // Add scale option to html2canvas for higher resolution image
    const imgData = canvas.toDataURL("image/jpeg", 1.0);
    const pdf = new jsPDF("p", "pt", [PDF_Width, PDF_Height]);
    pdf.addImage(
      imgData,
      "JPG",
      top_left_margin,
      top_left_margin,
      canvas_image_width / 2, // Divide canvas width by 2 to match the original HTML dimensions
      canvas_image_height / 2 // Divide canvas height by 2 to match the original HTML dimensions
    );
    for (let i = 1; i < totalPDFPages; i++) {
      pdf.addPage(PDF_Width, PDF_Height);
      pdf.addImage(
        imgData,
        "JPG",
        top_left_margin,
        -(PDF_Height * i) + top_left_margin * 4,
        canvas_image_width / 2, // Divide canvas width by 2 to match the original HTML dimensions
        canvas_image_height / 2 // Divide canvas height by 2 to match the original HTML dimensions
      );
    }
    pdf.save("Monthly Accomplishment Report (SlaughterHouse).pdf", {
      dpi: 300,
      compress: false, // Set compress option to false to generate a clearer image
    });
    $("#pdf").hide();
  });
}
function CreatePDFfromHTML() {
  var yow = document.getElementById("pdf-sm");
  yow.style.display = "block";
  var HTML_Width = 297;
  var HTML_Height = 210;
  var top_left_margin = 15;
  var PDF_Width = HTML_Width + top_left_margin * 1.5;
  var PDF_Height = PDF_Width * 1.3 + top_left_margin * 1.5;
  var canvas_image_width = HTML_Width;
  var canvas_image_height = HTML_Height - 10; // reduce the height by 60

  var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

  html2canvas($("#pdf")[0]).then(function (canvas) {
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF("p", "pt", [PDF_Width, PDF_Height]);
    pdf.addImage(
      imgData,
      "JPG",
      top_left_margin,
      top_left_margin,
      canvas_image_width,
      canvas_image_height
    );
    for (var i = 1; i <= totalPDFPages; i++) {
      pdf.addPage(PDF_Width, PDF_Height);
      pdf.addImage(
        imgData,
        "JPG",
        top_left_margin,
        -(PDF_Height * i) + top_left_margin * 4,
        canvas_image_width,
        canvas_image_height
      );
    }
    pdf.save("Monthly Accomplishment Report (SlaughterHouse)");
    $("#pdf").hide();
  });
}
// function CreatePDFfromHTML() {
//   var yow = document.getElementById("pdf-sm");
//   yow.style.display = "block";
//   var HTML_Width = 297;
//   var HTML_Height = 210;
//   var top_left_margin = 15;
//   var PDF_Width = HTML_Width + top_left_margin * 1.5;
//   var PDF_Height = PDF_Width * 1.3 + top_left_margin * 1.5;
//   var canvas_image_width = HTML_Width;
//   var canvas_image_height = HTML_Height;

//   var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

//   html2canvas($("#pdf")[0]).then(function (canvas) {
//     var imgData = canvas.toDataURL("image/jpeg", 1.0);
//     var pdf = new jsPDF("p", "pt", [PDF_Width, PDF_Height]);
//     pdf.addImage(
//       imgData,
//       "JPG",
//       top_left_margin,
//       top_left_margin,
//       canvas_image_width,
//       canvas_image_height
//     );
//     for (var i = 1; i <= totalPDFPages; i++) {
//       pdf.addPage(PDF_Width, PDF_Height);
//       pdf.addImage(
//         imgData,
//         "JPG",
//         top_left_margin,
//         -(PDF_Height * i) + top_left_margin * 4,
//         canvas_image_width,
//         canvas_image_height
//       );
//     }
//     pdf.save("Monthly Accomplishment Report (SlaughterHouse)");
//     $("#pdf").hide();
//   });
// }

//clone the schedule form
jQuery(function () {
  var index = 2;
  $("#add-animal").click(function () {
    var row = jQuery("#row-of-form").clone();
    jQuery(".animaltype", row).attr("id", "animaltype" + index);
    jQuery(".animaltype1", row).attr("id", "animaltype1" + index);
    jQuery(".animaltype", row).attr("id", "animals" + index);
    jQuery(".quantity", row).attr("id", "quantity" + index);
    jQuery(".weight", row).attr("id", "weight" + index);
    jQuery(".origin", row).attr("id", "origin" + index);
    jQuery(".remove", row)
      .attr("id", "remove" + index)
      .show();
    jQuery("#row-cloned").append(row);
    index++;
    //count the number of form
    $(function () {
      var set_number = function () {
        var div_len = $(".row-of-form").length - 1;
        $("#no").val(div_len);
      };
      set_number();
    });

    $("body").on("click", ".remove", function () {
      $(this).closest("#row-of-form").remove();
      var minus = $(".row-of-form").length - 1;
      $("#no").val(minus);
    });
  });
});
//Change Select to Input separately
$("body").on("change", ".test", function () {
  var $div = $(this).closest(".selected");
  var selected = $div.find("option:selected", this).attr("class");
  if (selected == "editable") {
    $div.find(".editOption").show();

    $div.find(".editOption").keyup(function () {
      var editText = $div.find(".editOption").val();
      $div.find(".editable").val(editText);
      // $div.find(".editable").html(editText);
    });
  } else {
    $div.find(".editOption").hide();
  }
});

// Validation Login
function addInvalidClass(validation, field) {
  if (validation.hasError(field)) {
    document.getElementById(field).classList.add("is-invalid");
  }
}

$("#buttonset").on("click", function (event) {
  event.preventDefault();
  // Get the selected date and time as a JavaScript Date object
  var selectedDate = new Date($("#flatpickr").val());
  // Get the current date and time
  var currentDate = new Date();

  // Check if the selected time is between 6:00pm and 3:00am
  var selectedHour = selectedDate.getHours();
  if (
    (selectedHour >= 18 && selectedHour <= 23) ||
    (selectedHour >= 0 && selectedHour <= 2)
  ) {
    // The selected time is within the disabled range, so display an error message
    $("#alert-message")
      .text("The selected time must be between 3:00am and 6:00pm.")
      .show();
    $("#datetime").prop("required", true);
  } else if (selectedDate.getTime() < currentDate.getTime()) {
    // The selected date and time is in the past, so display an error message
    $("#alert-message")
      .text("The selected date and time cannot be in the past.")
      .show();
    $("#datetime").prop("required", true);
  } else {
    // The selected date and time is valid, so check if the form is valid
    if ($("#setsched")[0].checkValidity()) {
      $("#setsched input").prop("required", true);
      // Submit the form
      $("#setsched").submit();
    } else {
      // Show the validation message
      $("#setsched")[0].reportValidity();
    }
  }
});

//disable the dates in flat picker if its more than 15
flatpickr("#flatpickr", {
  enableTime: true,
  disable: disabled,
  dateFormat: "Y-m-d H:i",
  minDate: "today",
});
