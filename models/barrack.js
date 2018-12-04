const mongoose = require("mongoose")

BarrackSchema = mongoose.Schema({
    name: {type: String, require: true, default: "DefaultArmory"},
    locationId : {type: mongoose.Schema.Types.ObjectId, ref: "Location"}
})
module.exports = mongoose.model("Barrack", BarrackSchema)
