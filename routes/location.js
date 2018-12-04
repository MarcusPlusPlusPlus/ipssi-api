const express = require("express");
const Location = require("../models/location");
const router = express.Router();

router.get("/", (req, res) => {
    Location.find({}, (err, locations) => {
        if(err || locations.length==0) { res.status(404).send({message: "No location found."}); return; }
        res.status(200).send({locations: locations})
    })
})

module.exports = router
