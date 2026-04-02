# PowerShell Auto-Sync Script for Portal Berita
# Tracks changes in D:\portal-berita\portal-berita and syncs to 192.168.1.8

$LOCAL_PATH = "D:\portal-berita\portal-berita"
$REMOTE_SERVER = "root@192.168.1.8"
$REMOTE_PATH = "~/portal-berita"

# Initialize FileSystemWatcher
$watcher = New-Object System.IO.FileSystemWatcher
$watcher.Path = $LOCAL_PATH
$watcher.IncludeSubdirectories = $true
$watcher.EnableRaisingEvents = $true

# Define exclusion patterns (regex)
$exclusions = "\.git|vendor|node_modules|storage|bootstrap/cache|\.ps1$"

$action = {
    $fullPath = $Event.SourceEventArgs.FullPath
    $relativePath = $fullPath.Replace($LOCAL_PATH + "\", "").Replace("\", "/")
    
    # Check for exclusions
    if ($fullPath -match $exclusions) { return }

    # Sync individual file
    $dest = "${REMOTE_SERVER}:${REMOTE_PATH}/$relativePath"
    
    # Get just the directory part for scp -r fallback
    $dirIndex = $relativePath.LastIndexOf('/')
    if ($dirIndex -gt -1) {
        $relDir = $relativePath.Substring(0, $dirIndex)
    }

    Write-Host "[$(Get-Date -Format 'HH:mm:ss')] Syncing: $relativePath ... " -NoNewline -ForegroundColor Cyan
    try {
        scp "$fullPath" "$dest"
        Write-Host "Success!" -ForegroundColor Green
    } catch {
        Write-Host "FAILED!" -ForegroundColor Red
        Write-Warning $_.Exception.Message
    }
}

# Register events
$handlers = @()
$handlers += Register-ObjectEvent $watcher "Changed" -Action $action
$handlers += Register-ObjectEvent $watcher "Created" -Action $action

Write-Host ">>> Auto-Sync AKTIF! Setiap kali Anda simpan file (Ctrl+S), akan otomatis terkirim." -ForegroundColor Yellow
Write-Host ">>> Folder: $LOCAL_PATH"
Write-Host ">>> Server: $REMOTE_SERVER"
Write-Host ">>> Tekan Ctrl+C untuk berhenti."

try {
    while ($true) { Start-Sleep 5 }
} finally {
    # Cleanup handlers on exit
    $handlers | ForEach-Object { Unregister-Event -SourceIdentifier $_.Name }
    Write-Host "`n>>> Auto-Sync Berhenti." -ForegroundColor Gray
}
