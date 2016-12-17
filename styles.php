   <style type="text/css">
   body {font-family:Verdana;}
   h3 {margin-bottom:0px;}
.expand {height:600px; background:#eee; overflow:scroll;padding:2%;}
.wide {width:95%;}
.wide td:nth-of-type(even) {  text-align:right;  }
.reps {float:right;}
.basic {width:95% }

.right {float:right; width:40%; }
.left {float:left;width:55%;margin-left:2%; }
.page_width {width:100%; background:#eee; background:#eee;}
.clear {clear:both;}
table.right td{text-align:right;}
a { color:#759e34; padding:5px; border-radius:5px; text-decoration:none; }
.basic td:nth-of-type(even) {  background:#cbdbd8; padding:10px; border-radius:5px; border: 1px;  }

.basic td:nth-of-type(odd) {  padding:10px; border-radius:5px; width:70px;  }

.overlaid { margin:auto;width:800px; font-size:18px; background:#cbdbd8; padding:20px; border-radius: 5px; }
.overlaid input[type="text"] {
	width:70%;
  padding: 10px;
  border: solid 1px #dcdcdc;
  transition: box-shadow 0.3s, border 0.3s;
}
.overlaid input[type="text"]:focus,
.overlaid input[type="text"].focus {
  border: solid 1px #707070;
  box-shadow: 0 0 5px 1px #969696;
}
.overlay { position: absolute; top: 0; bottom: 0; left: 0; right: 0;  background:#FFF;z-index: 1000; 
	transition: opacity 500ms; visibility: hidden;opacity: 0;}
.overlay:target {
  height:100%;
  visibility: visible;
  opacity: 1;
}
.popup{ width:500px; background-color:#fff; 
  margin: 10px 90px;
  padding: 20px;
  z-index: 1000;/*stops background showing through*/
  border-radius: 5px;
 
  position: relative;
  transition: all 2s ease-in-out;
}
.popup_menu { width:530px; background-color:#fff; 
  margin: 10px 90px;
  padding: 20px;
  z-index: 1000;/*stops background showing through*/
  border-radius: 5px;
  height:100%;
  position: relative;
  transition: all 5s ease-in-out;
}
.popup_search { width:90%; background-color:#fff; 
  margin: 30px 20px;
  padding: 20px;
  z-index: 1000;/*stops background showing through*/
  border-radius: 5px;
  height:800px;

  position: relative;
  transition: all 5s ease-in-out;
}


.popup .close { 
  position: absolute;
  top: 0px;
  left: 3px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #eee;
}
.popup .content { width:500px;
  max-height: 30%;

  overflow: auto;
}
.tiny{font-size:8px;  }

button { height:30px; width:50px;color:#fff; background:#eee; text-align:center;
  border:0 none;cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px; }

form.overlaid {
                width:500px;
                margin:50px auto;
}


</style>