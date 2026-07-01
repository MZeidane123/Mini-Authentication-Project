$watcher = New-Object System.IO.FileSystemWatcher
$watcher.Path = "D:\mini-project-auth\resources\views"
$watcher.IncludeSubdirectories = $true
$watcher.EnableRaisingEvents = $true

Register-ObjectEvent $watcher "Changed" -Action {
    $path = $Event.SourceEventArgs.FullPath
    if ($path -like "*.blade.php") {
        $relative = [System.IO.Path]::GetRelativePath("D:\mini-project-auth", $path)
        $containerPath = "/var/www/html/$($relative -replace '\\', '/')"
        docker cp $path "mini-project-auth-laravel.test-1:$containerPath" 2>$null
        Write-Host "[$(Get-Date -Format HH:mm:ss)] Synced: $relative"
    }
}

Write-Host "Memantau perubahan file blade..." -ForegroundColor Green
Write-Host "Tekan Ctrl+C untuk berhenti" -ForegroundColor Yellow
while ($true) { Start-Sleep -Seconds 1 }
