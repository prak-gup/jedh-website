#!/bin/bash

# JEDH Website - Local Server Start Script
# This script starts a local web server so you can test the website

echo "🏥 Starting JEDH Website Local Server..."
echo "📂 Serving from: $(pwd)"
echo ""
echo "✅ Server will start at: http://localhost:8000"
echo ""
echo "📋 To test the website:"
echo "   1. Open your browser"
echo "   2. Go to: http://localhost:8000"
echo "   3. Click around to test all pages"
echo ""
echo "⚠️  Press Ctrl+C to stop the server"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Start Python HTTP server
python3 -m http.server 8000
