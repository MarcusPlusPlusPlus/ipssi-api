const mongoose = require("mongoose")

let LocationSchema = mongoose.Schema({
    name: {type: String, require: true},
    gps: {
        lat: {type: Number, default: 48.892909},
        lng: {type: Number, default:  2.277726}
    }
})
module.exports = mongoose.model("Location", LocationSchema)
