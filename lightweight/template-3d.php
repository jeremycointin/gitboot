<? // template name: 3d ?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
    <title>Studio 2108</title>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/aframe.min.js"></script>
      <script src="https://rawgit.com/mayognaise/aframe-mouse-cursor-component/master/dist/aframe-mouse-cursor-component.min.js"></script>
      <script src="https://rawgit.com/ngokevin/aframe-text-component/master/dist/aframe-text-component.min.js"></script>
      <style>
      html body .a-canvas:hover{cursor:pointer !important; }.a-canvas.a-grab-cursor:active,.a-grabbing{cursor:pointer !important; }
       </style>
  </head>
  <body>
    <a-scene antialias="true">   
    
          <? 
		  $menu_pos[] = "-2 4 0";
          ?>

          <a-entity hyperlink id='menu_i_<? echo $key; ?>' material="color: #000000" position="<? echo $menu_pos[0];?>" text="text: STUDIO 2108" url=''></a-entity>
          <a-entity hyperlink id='menu_i_<? echo $key; ?>' material="color: #000000" position="-1 .5 0" text="text: 8; size: 3; height: .4;" url=''></a-entity>



      <a-plane hyperlinkid="floor" rotation="-90 0 0" width="60" height="60" color="#005400"></a-plane>

      <a-entity position="0 1.8 4" rotation="8 0 0">
        <a-entity camera="" look-controls="" mouse-cursor="" wasd-controls="fly: true;">
          
        </a-entity>
      </a-entity>

      <a-sky src="http://test.studio2108dev8.com/wp-content/uploads/2016/10/sky1.jpg"></a-sky>
      
      

    
    

      
      
    </a-scene>

    <script>


AFRAME.registerComponent('hyperlink', {
  init: function () {
    this.el.addEventListener('mouseenter', function () {
      var this_url = this.getAttribute("url");
      window.location = this_url;
    });
  }
});
    
    </script>
  </body>
</html>
