
<?php
	if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];
		$temp_file_location = $_FILES['image']['tmp_name'];

		require 'vendor/autoload.php';

		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-east-1',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIA3KUK4Z6LTP5YHPFN",
				'secret' => "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",
			]
		]);

		$result = $s3->putObject([
			'Bucket' => 'deploy-pdf',
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location
		]);

		echo var_dump($result);
	}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
	<input type="file" name="image" />
	<input type="submit"/>
</form>
