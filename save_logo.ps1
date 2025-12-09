$logoPath = "public/images/logo.png"
$logoUrl = "https://raw.githubusercontent.com/your-repo/xchange/main/public/images/logo.png"

# Create directory if it doesn't exist
New-Item -ItemType Directory -Force -Path "public/images"

# Download the logo
Invoke-WebRequest -Uri $logoUrl -OutFile $logoPath 