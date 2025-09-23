{ pkgs }: {
	deps = [
   pkgs.php82Extensions.pgsql
   pkgs.php82Extensions.pdo_pgsql
   pkgs.postgresql
		pkgs.php82
	];
}