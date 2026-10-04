const express = require('express');
const multer = require('multer');
const fs = require('fs');
const path = require('path');

const app = express();
const upload = multer({ dest: 'uploads/applications/' });

app.post('/api/careers/application', upload.single('cvFile'), (req, res) => {
    try {
        const applicationData = JSON.parse(req.body.applicationData);

        // Add file info to application data
        applicationData.cvFile = {
            name: req.file.originalname,
            path: req.file.path,
            size: req.file.size
        };

        // Save application data as JSON
        const jsonData = JSON.stringify(applicationData, null, 2);
        const jsonFileName = `applications/${Date.now()}_application.json`;

        fs.writeFileSync(jsonFileName, jsonData);

        res.json({
            success: true,
            message: 'Application submitted successfully',
            applicationId: `APP_${Date.now()}`
        });
    } catch (error) {
        console.error('Error processing application:', error);
        res.status(500).json({
            success: false,
            message: 'Error processing application'
        });
    }
});