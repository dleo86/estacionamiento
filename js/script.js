


function Nav() {   
   
  if ( document.querySelector("#left-panel").style.width == "270px"){  
        document.querySelector("#left-panel").style.width = "0px";
        document.querySelector("#row").style.width = "1828px";
        document.querySelector("#left-panel").style.transition = "0.5s";
    }else{
        document.querySelector("#left-panel").style.width = "270px";
        document.querySelector("#row").style.width = "1428px";
    }
   
}
