# Test PUT request for prodi
$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDovYXBpL2xvZ2luIiwiaWF0IjoxNzY3MDcyODg4LCJleHAiOjE3NjcwNzY0ODgsIm5iZiI6MTc2NzA3Mjg4OCwianRpIjoiRTUwVXVXaEpPWnlhTnNuTyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.dKPj0u5tvrvqoIug5kAXwjsdF831o0O3m9xOL1zcU-0"
$body = @{
    "fakultas_id" = 1
    "prodi_code" = "TI"
    "prodi_name" = "Teknik Informatika"
} | ConvertTo-Json

Write-Host "Testing PUT /api/prodi/1..." -ForegroundColor Cyan
Write-Host "Token: $token" -ForegroundColor Gray
Write-Host "Body: $body" -ForegroundColor Gray

try {
    $response = Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/prodi/1" `
        -Method PUT `
        -ContentType "application/json" `
        -Body $body `
        -Headers @{"Authorization" = "Bearer $token"} `
        -UseBasicParsing
    
    Write-Host "Status: $($response.StatusCode)" -ForegroundColor Green
    Write-Host "Response:" -ForegroundColor Green
    $response.Content | ConvertFrom-Json | ConvertTo-Json -Depth 10
} catch {
    Write-Host "Error: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Full Exception: $($_ | Out-String)" -ForegroundColor Red
}
