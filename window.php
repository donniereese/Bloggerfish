<?php
class window {
	var $win_count = 100;
	function create($title, $handle, $width, $height , $x, $y, $op_resize, $type, $app) {
		if ($type == "flat:opaque") {
			echo "<div id=\"" . $handle . "\" class=\"window\" style=\"width:" . $width . "px; height:" . $height . "px; overflow:hidden; position:absolute; top:" . $y . "px; left:" . $x . "px; z-index:" . $this->win_count . ";\">";
			echo "<div style=\"position:absolute; left:0px; top:0px; height:24px; width:8px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "<div style=\"position:absolute; right:0px; top:0px; height:24px; width:8px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "<div style=\"position:absolute; left:8px; right:8px; top:0px; height:24px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "<div id=\"movelayerDBar\" class=\"window.bar\" style=\"position:relative;cursor:move; margin:0px; padding:0px; color:#EEEEEE;height: 24px; text-align: left;\">";
			echo "<div style=\"position:absolute; left:8px; right:8px; top:2px; bottom:6px; font-size:14px; font-weight:bold; color:#a8c3d8;\">$title</div>";
			echo "</div>";
			echo "";
			echo "<div style=\"position:absolute; top:24px; left:0px; width:2px; bottom:8px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "";
			echo "<div style=\"position:absolute; top:24px; left:2px; right:2px; bottom:8px; background-color:#1A1827; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70; text-align:left; color:#eeeeff;\">";		
			if (empty($app)) {
				
			} else {
				include("user_apps/" . $app);
			}
			echo "</div>";
			echo "";
			echo "<div style=\"position:absolute; top:24px; right:0px; width:2px; bottom:8px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "";
			echo "<div style=\"position:absolute; left:0px; bottom:0px; height:8px; width:8px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "<div style=\"position:absolute; right:0px; bottom:0px; height:8x; width:8px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "<div style=\"position:absolute; left:8px; right:8px; bottom:0px; height:8px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70;\"></div>";
			echo "";
			echo "<div id=\"movelayerDDow\" style=\"height:8px; position:absolute; right:0px; left:0px; bottom:0px; cursor:move;\"></div>";
			if ($op_resize == "noresize") {
				
			} else {
				echo "<div id=\"movelayerRBtn\" style=\"height:8px; width:8px; position:absolute; right:0px; bottom:0px; background-color:#000000; filter:alpha(opacity=70); -moz-opacity:.70; opacity:.70; cursor:se-resize;\"></div>";
			}
			echo "</div>";
			echo "<script type=\"text/javascript\">";
			echo "win = \"movelayer\";";
			echo "Setup (win);";
			echo "maxZ = 100;";
			echo "</script>";
		} else {
			echo "<div id=\"" . $handle . "\" class=\"window\" style=\"width:" . $width . "px; height:" . $height . "px; overflow:hidden; position:absolute; top:" . $y . "px; left:" . $x . "px; z-index:" . $this->win_count . ";\">";
			echo "<div style=\"position:absolute; left:0px; top:0px; height:24px; width:8px;\"><img src=\"images/desktop/topleft.png\"></div>";
			echo "<div style=\"position:absolute; right:0px; top:0px; height:24px; width:8px;\"><img src=\"images/desktop/topright.png\"></div>";
			echo "<div style=\"position:absolute; left:8px; right:8px; top:0px; height:24px; background: url(images/desktop/toptile.png);\"></div>";
			echo "<div id=\"movelayerDBar\" class=\"window.bar\" style=\"position:relative;cursor:move; margin:0px; padding:0px; color:#EEEEEE;height: 24px; text-align: left;\">";
			echo "<div style=\"position:absolute; left:8px; right:8px; top:2px; bottom:6px; font-size:14px; font-weight:bold; color:#a8c3d8;\">$title</div>";
			echo "</div>";
			echo "";
			echo "<div style=\"position:absolute; top:24px; left:0px; width:8px; bottom:16px; background:url(images/desktop/leftborder.png);\"></div>";
			echo "";
			echo "<div style=\"position:absolute; top:24px; left:8px; right:8px; bottom:16px; background-color:#47495f; text-align:left; color:#eeeeff;\">";		
			if (empty($app)) {
				
			} else {
				include("user_apps/" . $app);
			}
			echo "</div>";
			echo "";
			echo "<div style=\"position:absolute; top:24px; right:0px; width:8px; bottom:16px; background:url(images/desktop/rightborder.png);\"></div>";
			echo "";
			echo "<div style=\"position:absolute; left:0px; bottom:0px; height:16px; width:8px;\"><img src=\"images/desktop/bottomleft.png\"></div>";
			echo "<div style=\"position:absolute; right:0px; bottom:0px; height:16px; width:8px;\"><img src=\"images/desktop/bottomright.png\"></div>";
			echo "<div style=\"position:absolute; left:8px; right:8px; bottom:0px; height:16px; background: url(images/desktop/bottomtile.png);\"></div>";
			echo "";
			echo "<div id=\"movelayerDDow\" style=\"height:16px; position:absolute; right:0px; left:0px; bottom:0px; cursor:move;\"></div>";
			if ($op_resize == "noresize") {
				
			} else {
				echo "<div id=\"movelayerRBtn\" style=\"height:8px; width:8px; position:absolute; right:0px; bottom:0px; background:url(images/desktop/resize.png); cursor:se-resize;\"></div>";
			}
			echo "</div>";
			echo "<script type=\"text/javascript\">";
			echo "win = \"movelayer\";";
			echo "Setup (win);";
			echo "maxZ = 100;";
			echo "</script>";
		}
	}
}
?>