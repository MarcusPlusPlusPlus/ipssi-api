const mongoose = require("mongoose")

let MissionSchema = mongoose.Schema({
    name: {type: String, require: true, default: "DefaultMission"},
    type: {type: String, require: true},
    description: String,
    locationId: {type: mongoose.Schema.Types.ObjectId, ref: "Location", require: true},
    listOfGroup : {type: [mongoose.Schema.Types.ObjectId], ref: "Group", require: true},
    dates: {
        start: {type: Number, default: Date.now()},
        end: Number
    }

})
module.exports = mongoose.model("Mission", MissionSchema)
