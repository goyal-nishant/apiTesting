<?php
$membership_type = get_query_var('membership_type');
 ?>

<fieldset class="inline-edit-col-left">
    <div class="inline-edit-col">
        <label class="inline-edit-group">
            <span class="title">Membership Restriction</span>
            <span class="input-text-wrap">
                <select name="membership_type">
                    <option value="paid" <?php // if (strtolower($membership_type) === 'Paid') echo 'selected="selected"'; ?>>Paid</option>
                    <option value="unpaid" <?php //if (strtolower($membership_type) === 'Unpaid') echo 'selected="selected"'; ?>>Unpaid</option>
                </select>   
            </span>
        </label>
    </div>
</fieldset> 
