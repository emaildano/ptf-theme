<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  Due to COVID-19 concerns many bars are currently closed or limited in service to take-out only. Please contact any establishments directly to make sure they are still open before visiting.
</div>

<script>
// Get all elements with class="closebtn"
var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
  // When someone clicks on a close button
  close[i].onclick = function(){

    // Get the parent of <span class="closebtn"> (<div class="alert">)
    var div = this.parentElement;

    // Set the opacity of div to 0 (transparent)
    div.style.opacity = "0";

    // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

<style type="text/css">
  /* The alert message box */
  .alert {
    opacity: 1;
    font-size: 1rem;
    transition: opacity 0.6s; /* 600ms to fade out */
    padding: 20px;
    background-color: #eee;
    color: #000;
    max-width: 980px;
    margin: 1rem auto;
    box-sizing: border-box;
  }

  /* The close button */
  .closebtn {
    margin-left: 15px;
    color: #ab151a;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  /* When moving the mouse over the close button */
  .closebtn:hover {
    color: black;
  }
</style>