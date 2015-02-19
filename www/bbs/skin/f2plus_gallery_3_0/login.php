
<table width='<?=$setup['table_width']?>' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td align='center' style='padding:30 0 30 0;'>
		<table width='250' border='0' cellpadding='0' cellspacing='0' background='<?=$dir?>/images/sw_window_bgi.gif' style='word-break:break-all; background-repeat:repeat-y;'>
		<tr><td><img src='<?=$dir?>/images/sw_window_t.gif' border='0'></td></tr>
		<tr>
			<td align='center' style='padding:7 0 7 0;' class='sw_ft_style_0'><strong>회원 로그인</strong></td>
		</tr>
		<tr><td class='sw_bg_style_0'></td></tr>
		<tr>
			<td align='center' style='padding:7;'>
				<table border='0' cellpadding='0' cellspacing='0'>
				<tr height='25'>
					<td align='right' class='sw_ft_style_0'>아이디</td>
					<td align='left' style='padding:0 0 0 5;'><input type='text' name='user_id' maxlength='20' class='text' style='width:90;'> <input type=checkbox name=SSL_Login value=1 checked onclick=check_SSL_Login() title="보안접속 설정/해제"></td>
				</tr>
				<tr height='25'>
					<td align='right' class='sw_ft_style_0'>비밀번호</td>
					<td align='left' style='padding:0 0 0 5;'><input type='password' name='password' maxlength='20' class='text' style='width:90;'></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr><td class='sw_bg_style_0'></td></tr>
		<tr>
			<td align='center' style='padding:7 0 7 0;'>
				<input type='submit' class='submit' value='로그인' style='margin:0 5 0 0;'>
				<input type='button' class='button' value='취&nbsp;&nbsp;&nbsp;소' onClick='history.back();'>
			</td>
		</tr>
		<tr><td><img src='<?=$dir?>/images/sw_window_b.gif' border='0'></td></tr>
		</table>
	</td>
</tr>
</table>
