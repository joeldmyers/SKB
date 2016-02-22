<tr>
	<td><?php echo get_the_title( $data['investor_investment'] );?></td>
	<td><?php echo $data['investor_investment_entity'] ;?></td>
	<td><?php echo $data['investor_investment_type'] ;?></td>
	<td><?php echo $data['investor_investment_status'] ;?></td>
	<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', $data['investor_investment_original_capital'] ); ?></td>
	<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', $data['investor_investment_returned_capital'] ); ?></td>
	<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', $data['investor_investment_transfer_adjustments'] ); ?></td>
	<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', $data['investor_investment_current_capital'] ); ?></td>
	<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', $data['investor_investment_income_distributions'] ); ?></td>
	<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', $data['investor_investment_other_distributions'] ); ?></td>
</tr>