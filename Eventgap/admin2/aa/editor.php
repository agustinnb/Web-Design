<?php include 'includes/document_head.php'?>
		<div id="wrapper">		
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/navigation.php'?>		
				<div class="flat_area grid_16">
					<h2>Rich Text Editor <small>(WYSIWYG)</small></h2>
					<p><strong>Adminica</strong> utilizes <strong>TinyMCE</strong>, one of the most popular online rich text editors.
This editor has all the usual formatting options you expect. It can be toggled and sorted like any other <strong>Adminica</strong> box.</p>
				</div>
				<div class="box grid_16 round_all">
					<h2 class="box_head grad_colour round_top">Tiny Editor</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="block no_padding">
						<textarea id="tiny_input"></textarea>					
					</div>
				</div>
				<div class="flat_area grid_16">
					<p><strong>Note:</strong> TinyMCS <strong>does not support iOS devices</strong> at this time. It displays just fine but cannot call the keyboard up for editing. TinyMCE should have a fix for this fairly soon.</p>
				</div>
			</div>
		
			<script type="text/javascript">
			new TINY.editor.edit('editor',{
				id:'tiny_input',
				height:200,
				cssclass:'te',
				controlclass:'tecontrol',
				rowclass:'teheader',
				dividerclass:'tedivider',
				controls:['bold','italic','underline','strikethrough','|','subscript','superscript','|',
						  'orderedlist','unorderedlist','|','outdent','indent','|','leftalign',
						  'centeralign','rightalign','blockjustify','|','unformat','|','undo','redo','n','image','hr','link','unlink','|','cut','copy','paste','print','|','font','size','style'],
				footer:false,
				fonts:['Arial','Verdana','Georgia','Trebuchet MS'],
				xhtml:true,
				cssfile:'style.css',
				bodyid:'editor',
				footerclass:'tefooter',
				toggle:{text:'source',activetext:'wysiwyg',cssclass:'toggler'},
				resize:{cssclass:'resize'}
			});
			</script>

		</div>
<?php include 'includes/closing_items.php'?>