<?php
	// Prevent direct access
	if (!defined('thisismychild'))
	{
		header('location: /index.php');
		exit();
	}
?>
	<div class="footer">
		<div class="content">
			<div>Copyright ft_minishop — <?php echo date("Y") ?></div>
		</div>
	</div>
</body>
</html>