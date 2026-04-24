
<table border="1" cellpadding="10">
<tr><th>Rank</th><th>User</th><th>Score</th></tr>
<?php $no=1; foreach($ranking as $r): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $r->user_id ?></td>
<td><?= $r->score ?></td>
</tr>
<?php endforeach; ?>
</table>
