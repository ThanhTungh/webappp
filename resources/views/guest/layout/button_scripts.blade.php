<!-- button "join" vs "leave" -->
<script>
    function joinFaculty(button) {
  const leaveButton = document.createElement("button");
  leaveButton.type = "button";
  leaveButton.classList.add("btn", "btn-danger");
  leaveButton.onclick = function() { removeFaculty(this); };
  leaveButton.innerHTML = '<i class="feather mr-2 icon-trash"></i>Leave';
  const actionCell = button.parentElement;
  actionCell.replaceChild(leaveButton, button);
}
function removeFaculty(button) {
  const joinButton = document.createElement("button");
  joinButton.type = "button";
  joinButton.classList.add("btn", "btn-success");
  joinButton.onclick = function() { joinFaculty(this); };
  joinButton.innerHTML = '<i class="feather mr-2 icon-plus-circle"></i>Join';
  button.parentElement.replaceChild(joinButton, button);
}
</script>