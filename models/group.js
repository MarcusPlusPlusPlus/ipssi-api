const mongoose = require("mongoose")

let GroupSchema = mongoose.Schema({
    name: {type: String, require: true, default: "DefaultGroup"},
    barrackId: {type: mongoose.Schema.Types.ObjectId, ref: "Barrack"},
    listOfPersons : {type: [mongoose.Schema.Types.ObjectId], ref: "Person"}

})
module.exports = mongoose.model("Group", GroupSchema)
