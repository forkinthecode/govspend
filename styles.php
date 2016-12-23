   <style type="text/css">
   body {font-family:Verdana; font-size:12px; color:#333; max-width:1500px;}
 
 
   #submit {background:#FFF; border:none; height:35px;

 }
 .source {font-size:10px; width:85%; margin-left:2px; margin-right:2px; padding:5px; }
 .scroller {width:85%; height:15px; text-align:left; 
opacity:0.7; padding:5px;}
   
   
   img{
    -khtml-user-select: none;
    -o-user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
}
 
 select {border:none; width:75%; font-size:18px; height:25px; padding:10px; }
   /*
       input,select { width:35%; font-size:18px; height:25px;}
       input, select { height:30px; display:inline; 
            
            font-size:.90em ; 
            outline:none; 
            font-family:inherit; 
                                      }*/
.council { margin-top:10px;width:95%; text-align:center;}
.council td:nth-of-type(odd) {  background:#eee; margin:5px; }
.council td:nth-of-type(even) {  background:#cbdbd8; margin:5px; }
.expand {height:400px; overflow:scroll; padding:2%;}
.issues {display:inline;}
.mps {width:95%;}
.reps {float:right; margin:1%; }
.stats {width:95%; font-size:15px;}
.stats td:nth-of-type(even) {   padding:10px; line-height:24px; background:#eee;}
.stats td:nth-of-type(odd) {  padding:10px;  line-height:24px; background:#cbdbd8; }
     

@media (max-width: 519px) {

    .right {float:right; width:95%; }
    .left  {float:left; width:95%; margin-left:2%; }
    

  
}

@media (min-width: 520px) and (max-width: 700px)   {

    .right {float:right; width:95%; }
    .left  {float:left; width:95%; margin-left:2%; }

  
}
@media (min-width: 701px)  {
 
.right {float:right; width:40%; }
.left  {float:left; width:52%; margin-left:2%; }

      
}


   
}
.description {width:300px; height:200px; overflow:scroll;}

.page_width { max-width:1250px; }
.clear { clear:both;}

a { color:#759e34; padding:5px; border-radius:5px; text-decoration:none; }

.wide {width:95%; padding:10px; font-size:15px; line-height:18px; border: 1px; border-style: dashed;  } 
.wide td:nth-of-type(even) {   background:#cbdbd8; text-align:right;}
.wide tr:nth-of-type(even) {   background:#eee; }


.basic { width:90%;   border: solid 1px #dcdcdc; padding:10px;}
.basic tr:nth-of-type(even) {  background:#cbdbd8; border-radius:5px; border: 1px; width:400px; line-height:18px; }
.basic tr:nth-of-type(odd) {   border-radius:5px; line-height:18px;}
.basic td:nth-of-type(odd) {  text-align:right;}
.basic td {  padding:2px; margin-left:5px;margin-right:5px;}
.grants {width:95%; line-height:18px;}
.grants td:nth-of-type(even) {   text-align:right;}

.overlaid { position: relative; top: 80px;  left: 30px; }
.overlaid input[type="text"] {
  width:60%;
  padding: 10px;
  border: solid 1px #dcdcdc;
  transition: box-shadow 0.3s, border 0.3s;
}
.overlaid input[type="text"]:focus,
.overlaid input[type="text"].focus {
  border: solid 1px #707070;
  box-shadow: 0 0 5px 1px #969696;
}


li { list-style: none; }

/*.container { margin: 0px 20% 0px 20%; }*/

#head { margin-top: 20px; }


#menu .box { 
  position: fixed;
  text-align: left;
  overflow: scroll;
  z-index: -1;
  opacity: 0;
  width: 300px;
  height: 100%;
  /*left: 30px;*/
  top: 0px;
  background:RGBA(220, 231, 235, 1);
  -webkit-transition: all 0.3s ease-in-out; 
  -moz-transition: all 0.3s ease-in-out; 
  -o-transition: all 0.3s ease-in-out; 
  transition: all 0.3s ease-in-out;
}

#menu ul {
  position: relative;
  top: 150px;
  -webkit-transform: scale(2);
  -moz-transform: scale(2);
  -ms-transform: scale(2);
  transform: scale(2);
  -webkit-transition: all 0.3s ease-in-out; 
  -moz-transition: all 0.3s ease-in-out; 
  -o-transition: all 0.3s ease-in-out; 
  transition: all 0.3s ease-in-out;
}

#menu li { 
  /*display: inline-block;*/ 
  margin: 20px;
}

#menu li a {
  border-radius: 3px;
  padding: 15px;
  border: 1px solid transparent;
  text-decoration: none;
  font-size: 18px;
  color: #eoeoeo;
  -webkit-transition: all 0.2s ease-in-out; 
  -moz-transition: all 0.2s ease-in-out; 
  -o-transition: all 0.2s ease-in-out; 
  transition: all 0.2s ease-in-out;
}

#menu li a:hover { border-color: #fff; }

#menu li a i { 
  margin-right: 5px; 
  font-size: 24px;
}

#toggle-nav-label {
  color: #759e34;
  background: #dce7eb;
  text-align: center;
  line-height: 30px;
  font-size: 24px;
  display: block;
  cursor: pointer;
  position: relative;
  z-index: 500;
  width: 250px;
  height: 30px;
margin-left:40px;
margin-bottom:30px;
border-radius:5px;
      
 
  
}

#toggle-nav { display: none; }

#toggle-nav:checked ~ .box { 
  opacity: 1;
  z-index: 400;
}

#toggle-nav:checked ~ .box ul {
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

#toggle-nav:checked ~ #toggle-nav-label { 
  background: #FFF; 
  color: #759e34;;
}


</style>