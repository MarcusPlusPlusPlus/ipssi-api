const express = require("express");
const mongoose = require("mongoose")
const Mission = require("../models/mission");
const router = express.Router();

router.get("/:id", (req, res, next) => {
    Mission.find({_id:req.params.id}, (err, mission) => {
        if(err || missions.length==0) { res.status(400).send({error: `Coudn't find mission ${req.params.id}.`}); return; }
        res.status(200).send({mission: mission})
    })
})

router.post("/", (req, res) => {
    Mission.find({_id:req.param.id}, (err, mission) => { if(err || mission.length>0) { res.statue(400).send({error: "Cannot create mission."}); return; } })
    
    for (const element of req.body.listOfGroup)
    req.body.listOfGroup[req.body.listOfGroup.indexOf(element)] = mongoose.Types.ObjectId(element) 
    req.body.locationId = mongoose.Types.ObjectId(req.body.locationId)  
    
    let mission = new Mission()
    Object.assign(new Mission(), req.body)
    // mission.save(err => { if(err) { res.status(403).send(err); return; } })
    res.send(200).send({message: `Mission created !`})
})

router.get("/", (req, res) => {
    Mission.find({}, (err, missions) => {
        if(err || missions.length==0) { res.status(400).send({error: "No missions found."}); return; }
        res.status(200).send({missions: missions})
    })
})

module.exports = router
