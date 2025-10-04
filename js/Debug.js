const DEBUG_LOG = document.createElement("div");
    DEBUG_LOG.id = "DEBUG_LOG";

window.onload = () => {
    document.body.appendChild(DEBUG_LOG);
};

function AddDebugLine(line)
{
    DEBUG_LOG.innerHTML += line;
}