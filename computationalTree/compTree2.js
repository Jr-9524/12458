// nested objects
// Strings that starts with '1'
const transitions = {
    'q0': { '0': 'q0','0': 'q1', '1': 'q0' }, 
    'q1': { '0': 'q1', '1': 'p' },
    'p' : { '0': 'q1'}
};

function test() {
    const input = document.getElementById('inputString').value.trim(); // dito mapunta yung value ng tinype mo. Ignore whitespaces

    let currentState = 'q0';
    let accepted = false;
    const transitionLog = []; 
    document.getElementById('initial').innerText = `Start State ${currentState}`;

    for (let i = 0; i < input.length; i++) {
        const element = input[i];

        if (transitions[currentState] && transitions[currentState][element]) {
            const nextState = transitions[currentState][element];
            transitionLog.push(`${element} → '${currentState}' → '${nextState}'`); // yung .push eii mag lagay lang ng maglagay ng element sa array
            currentState = nextState;
        } else {
            currentState = 'p';
            break;
        }
    }
    console.log(currentState);
    accepted = currentState === 'q1' && input.endsWith('0');
    document.getElementById('result').innerText = accepted ?
        `The string "${input}" is accepted.\nTransitions:\n${transitionLog.join('\n')}` : // .join, pagsamasamahin yung mga element ng array
        `The string "${input}" is not accepted.\nTransitions:\n${transitionLog.join('\n')}`;
}