$(document).ready(function () {
  // Redirects to home.php when the #homeBtn button is clicked
  $("#homeBtn").click(function () {
    window.location.href = "home.php";
  });
  // Toggles the visibility of the #deleteForm when the #deleteBtn button is clicked
  $("#deleteBtn").click(function () {
    $("#deleteForm").toggle();
  });

  // hides the #deleteForm
  $("#deleteForm").hide();

  // Apply DataTables plugin to the table
  $("table").DataTable();
});
