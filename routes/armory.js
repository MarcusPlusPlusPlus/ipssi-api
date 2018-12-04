const express = require("express");
const Item = require("../models/item");
const router = express.Router();

router.get("/", (req, res) => {
    Item.find({}, (err, armory) => {
        if(err || armory.length==0) { res.status(404).send({message: "No location found."}); return; }
        res.status(200).send({armory: armory})
    })
})

module.exports = router
