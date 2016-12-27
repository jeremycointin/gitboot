<? // template name: 3d 2 ?>


<?php get_header(); ?>

<? global $post_page_options; ?>


  <style>
  
  .a_frame_wrap {
	  position: fixed; 
	  top: 0px;
	  left: 0px;
  }
  
  .a-canvas.a-grab-cursor:hover {
	  cursor: default !important;
  }
  
  
  </style>
  
    <div class="a_frame_wrap">
    <a-scene antialias="true" vr-mode-ui="enabled: false">
    
	  <a-box color="blue" depth="1" height="1" width="1" ></a-box>	
	  
          <a-entity hyperlink id='menu_i_<? echo $key; ?>' material="color: #000000" position="<? echo $menu_pos[0];?>" text="text: STUDIO 2108" url=''></a-entity>
          <a-entity hover hyperlink id='menu_i_<? echo $key; ?>' material="color: #000000" position="-1 .5 0" text="text: 8; size: 3; height: .4;" url=''></a-entity>

      <a-entity position="0 1.8 4" rotation="8 0 0">
        <a-entity camera="" look-controls="" mouse-cursor="" >
          
        </a-entity>
      </a-entity>      
      
    </a-scene>
    </div> 
    
    <script>


AFRAME.registerComponent('hyperlink', {
  init: function () {
    this.el.addEventListener('click', function () {
      var this_url = this.getAttribute("url");
      window.location = this_url;
    });
  }
});

AFRAME.registerComponent('hover', {
  init: function () {
    this.el.addEventListener('mouseenter', function () {
		alert('hovered');
    });
  }
});
    
    </script>
       <?php get_footer(); ?>
       
  </body>

</html>
