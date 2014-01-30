		<div class="content-box-header">
			<h3>
				Navigatie
			</h3>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<form action="<?php echo get_url('nav/salveaza_nav'); ?>" method="post" name="addNav" id="addNav">
				<fieldset>
					<p>
						<label for="numeNav">Nume buton navigatie</label> <input type="text" class="text-input small-input" name="numeNav" size="45">
					</p>
					<p>
						<label for="urlNav">Adresa buton navigatie</label> <input type="text" class="text-input small-input" name="urlNav" size="45">
					</p>
					<p>
						<label for="controllerNav">Controller buton navigatie</label> <input type="text" class="text-input small-input" name="controllerNav" size="45">
					</p>
					<p>
						<label for="parentControllerNav">Parent Controller nav</label> <select name="parentControllerNav" class="selectInput">
					</p>
					<p>
							<option value="0">
								Buton principal
							</option><?php Nav::generateDropDown(); ?>
						</select>
					</p>
					<?php
					global $__CONN__;
					$sql = "SELECT weight FROM admin_menu ORDER BY weight DESC LIMIT 0, 1";
					$stmt = $__CONN__->prepare($sql);
					$stmt->execute();
					$data = $stmt->fetchObject();
					?><input type="hidden" value="<?php echo $data->weight; ?>" name="orderNav"><br>
				<p>
						<input type="submit" name="submitNav" class="button" value="Submit">
				</p>
				</fieldset>
			</form>
		</div>