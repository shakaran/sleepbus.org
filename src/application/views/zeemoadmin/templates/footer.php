 <?php
 if(!empty($this->admin_id))
 {
  if($this->data['active_module'] != "home")
  {
   ?> 
                  </div>
                 <div id="div_bottom_cms"></div>
                </div>
               </td>
              </tr>
             </table>
            </div>
           </td>
          </tr>
          <tr>
           <td align="center">&nbsp;</td>
          </tr>
         </table>

         <div class="clear"></div>

   <?php
  }
  ?>



<div id="footer_text" align="center">
<div id="copyright"><a style="text-decoration: none; color: #ffffff; font-family:Arial" href="http://www.zeemo.com.au" alt="Web Design Melbourne, Sydney" title="Web Design Melbourne, Sydney">Powered by Zeemo Pty Ltd</a><br />
Contact us <?php echo ZEEMO_CONTACT_NO; ?> for support</div>
</div>
</div>
</div>

<script language="javascript">
var x,y,innerH;
if (self.innerHeight) // all except Explorer
{
	x = self.innerWidth;
	y = self.innerHeight;
}
else if (document.documentElement && document.documentElement.clientHeight)
	// Explorer 6 Strict Mode
{
	x = document.documentElement.clientWidth;
	y = document.documentElement.clientHeight;
}
else if (document.body) // other Explorers
{
	x = document.body.clientWidth;
	y = document.body.clientHeight;
}

document.getElementById("wrapper_cms").style.minHeight=y + 'px';
innerH=y-190;
document.getElementById("setInnerHeight").style.minHeight=innerH+ 'px';

</script>
<?php
 }
?>
</body>
</html>