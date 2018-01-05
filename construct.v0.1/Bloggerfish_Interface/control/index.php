<?php include("../header.php"); ?>

<script type="text/javascript">
function openapp(appname) {
  myapppool = xGetElementById("app-pool");
  getappinit = "<divstyle='background-color:#fcfcfa; color:#333333;'>Hello, World!</div>";
  myapppool.innerHTML = myapppool.innerHTML + getappinit;
}
</script>

<h2>Welcome to your Control Panel.</h2>
<div style="width:200px;">
  <h2 style="border-bottom:1px dashed #eeeeee; margin-bottom:4px;"><a href="">Get Started</a></h2>
  <h3 style="border-bottom:1px dashed #eeeeee; margin-bottom:4px;">About:</h3>
  <a href="#">My Profile</a>
  <a href="#"></a>

  <h3 style="border-bottom:1px dashed #eeeeee; margin-bottom:4px;">Your Page:</h3>
  <a href="#">My Profile</a>
  <a href="#"></a>

  <h3 style="border-bottom:1px dashed #eeeeee; margin-bottom:4px;">Your Apps:</h3>
  <a href="#">Center</a>
  <a href="#">Calendar</a>
  <a href="#">Leaf(note)</a>
  <a href="#">FeedMe</a>
  <a onclick="openapp();">Sample Mini App</a>
  <a href="#">Add an App</a>
  
  <h3 style="border-bottom:1px dashed #eeeeee; margin-bottom:4px;">Your Files:</h3>
  <a href="#">Pictures</a>
  <a href="#">Pages</a>
  <a href="#">Notes</a>
  <a href="#">Drafts</a>
  <a href="#">Other</a>
  
  <h3 style="border-bottom:1px dashed #eeeeee; margin-bottom:4px;">Settings:</h3>
  <a href="#">Preferences</a>
  <a href="#">Privacy</a>
</div>

<div id="app-pool">
</div>
<?php include("../footer.php"); ?>
