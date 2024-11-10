// NFA
// String that ends with zero
const transitions = {
    'q0': { '0': ['q0', 'q1'], '1': ['q0'] }, 
    'q1': { '0': ['p'], '1': ['p'] }
};

function test() {
    const input = document.getElementById('inputString').value.trim();
    let currentStates = ['q0']; 
    const transitionLog = []; 
    document.getElementById('initial').innerText = `Start State: 'q0'`;
    document.getElementById('final').innerText = `Final State: 'q1'`;

    for (let i = 0; i < input.length; i++) {
        const element = input[i];
        const newStates = []; 

        for (let j = 0; j < currentStates.length; j++) {
            const state = currentStates[j];

            if (transitions[state] && transitions[state][element]) {
                const nextStates = transitions[state][element];

                for (let k = 0; k < nextStates.length; k++) {
                    const nextState = nextStates[k];
                    transitionLog.push(`'${state}' → '${element}' → '${nextState}'`);
                    newStates.push(nextState);
                }
            }        
        }

        if (newStates.length > 0) {
            currentStates = newStates;
        } else {
            currentStates = ['p'];
        }
    }

    let accepted = false;
    if (currentStates.includes('q1') && input.endsWith('0')) {
        accepted = true;
    }

    if (accepted) {
        document.getElementById('result').innerText = 
            `The string "${input}" is accepted.\nTransitions:\n${transitionLog.join('\n')}`;
    } else {
        document.getElementById('result').innerText = 
            `The string "${input}" is not accepted.\nTransitions:\n${transitionLog.join('\n')}`;
    }
}