<?php
 $this->load->view('templates/cta'); 
 ?>
 <footer <?php if(($active_menu =="signin") || ($active_menu =="account") || ($active_menu =="user") || ($active_menu =="pledge") || ($active_menu =="fundraise" )|| ($active_menu =="donation")){?> class="mrtopnone" <?php }?>>
 <?php
 echo $footer_text['content'];
 ?>
 </footer>
 <?php
 $this->websitejavascript->IncludeFooterJsFiles();  
?>
<script>
    window.onbeforeunload = function(){
        window.scrollTo(0,0);
    }
</script>
</body>
</html>