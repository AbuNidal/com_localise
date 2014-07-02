<?php
/**
 * @package     Com_Localise
 * @subpackage  views
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.modal');
JHTML::_('stylesheet', 'com_localise/localise.css', null, true);
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.modal');

$listOrder  = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
$saveOrder  = $listOrder == 'tag';
$sortFields = $this->getSortFields();
?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<script type="text/javascript">
<!--
	Joomla.submitbutton = function submitbutton(task)
	{
		if (task == 'package.download')
		{
			var s=null;
			for (var i = 0, n = document.adminForm.elements.length; i < n; i++)
			{
				var e = document.adminForm.elements[i];
				if (e.type == 'checkbox' && e.name=='cid[]' && e.checked)
				{
					s = e.value;
					break;
				}
			}
			if (s!=null)
			{
				SqueezeBox.open('index.php?option=com_localise&task=package.download&cid[]='+s, {handler: 'iframe', size: {x: 500, y: 500}});
			}
		}
		else
		{
			submitform(task);
		}
	}
// -->
</script>
<form action="<?php echo JRoute::_('index.php?option=com_localise&view=packages');?>" method="post" name="adminForm" id="adminForm">
	<?php echo $this->loadTemplate('filter'); ?>
		<table class="table table-striped" id="localiseList">
			<thead>
				<?php echo $this->loadTemplate('head'); ?>
			</thead>
			<tfoot>
				<?php echo $this->loadTemplate('foot'); ?>
			</tfoot>
			<tbody>
				<?php echo $this->loadTemplate('body'); ?>
			</tbody>
		</table>
		<div>
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</div>
	<!-- End Content -->
</form>

<div  id="fileModal" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?php echo JText::_('COM_LOCALISE_IMPORT_NEW_PACKAGE_HEADER');?></h3>
	</div>
	<div class="modal-body">
		<div class="column">
			<form method="post" action="<?php echo JRoute::_('index.php?option=com_localise&task=package.uploadFile&file=' . $this->file); ?>"
				class="well" enctype="multipart/form-data" >
				<fieldset>
					<input type="hidden" class="address" name="address" />
					<input type="file" name="files" required />
					<input type="submit" value="<?php echo JText::_('COM_LOCALISE_BUTTON_IMPORT');?>" class="btn btn-primary" />
				</fieldset>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal"><?php echo JText::_('COM_LOCALISE_MODAL_CLOSE'); ?></a>
	</div>
</div>
