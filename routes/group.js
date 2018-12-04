const express = require("express");
const Group = require("../models/group");
const router = express.Router();

router.get("/", (req, res) => {
    Group.find({}, (err, groups) => {
        if(err || groups.length==0) { res.status(404).send({message: "No groups found."}); return; }
        res.status(200).send({groups: groups})
    })
})

module.exports = router
